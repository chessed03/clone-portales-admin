<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    protected $casts = [
        'permissions'  => 'json'
    ];

    const TABLE      = "permissions";

    const REMOVED    = 0;

    const ALIVE      = 1;

    public static function getPermissions( $user_id )
    {
        $permissions = null;

        $query = self::where('user_id', $user_id)
            ->where('status', self::ALIVE)
            ->first();

        if ( $query ) {

            $permissions = $query->permissions;

        }

        return $permissions;
    }

    public static function generatePermissions( $data )
    {
        $query = self::where('user_id', $data->user_id)
            ->where('status', 1)
            ->first();

        if ( $query ) {

            $item = $query;
            $item->user_id     = $data->user_id;
            $item->permissions = $data->permissions;
            $item->created_by  = auth()->user()->id."-".auth()->user()->name;

            if ( $item->update() ) {

                Binnacle::binnacleRegister( 'update', self::TABLE, 'permissions', $item->id );

                return true;

            }

        } else {

            $item = new self();
            $item->user_id     = $data->user_id;
            $item->permissions = $data->permissions;
            $item->created_by  = auth()->user()->id."-".auth()->user()->name;

            if ( $item->save() ) {

                Binnacle::binnacleRegister( 'create', self::TABLE, 'permissions', $item->id );

                return true;

            }

        }

        return false;
    }

    public static function getPermissionsById( $id )
    {
        $result = null;

        $query  = self::where('user_id', $id )
            ->where('status', self::ALIVE)
            ->first();

        if ( $query ) {

            $result = $query;

        }

        return $result;
    }

    public static function addNewSchool( $id )
    {

        $user_id         = auth()->user()->id;

        $permissions     = self::find( $user_id );

        $new_permissions = [];

        foreach ( $permissions->permissions as $p => $permission ) {

            array_push($permission['write'], strval($id));

            $new_permissions[$p] = [
                'read'      => array_unique( $permission['read'] ),
                'write'     => array_unique( $permission['write'] ),
                'module_id' => $permission['module_id']
            ];

        }

        $permissions->permissions = $new_permissions;

        $permissions->update();

        if ( $user_id != 1 ) {

            $user_root            = 1;

            $permissions_root     = self::find( $user_root );

            $new_permissions_root = [];

            foreach ( $permissions_root->permissions as $r => $permission_root ) {

                array_push($permission_root['write'], strval($id));

                $new_permissions_root[$r] = [
                    'read'      => array_unique( $permission_root['read'] ),
                    'write'     => array_unique( $permission_root['write'] ),
                    'module_id' => $permission_root['module_id']
                ];

            }

            $permissions_root->permissions = $new_permissions_root;

            $permissions_root->update();

        }

        return true;

    }

    public static function deletePermissions( $user_id )
    {

        $query = self::where('user_id', $user_id)->first();

        if ( $query ) {

            $query->delete();

        }

        return true;

    }

    public static function getDataSchool( $schools )
    {
        return School::getAliveSchoolsByArrayId( $schools );
    }

    public static function getDataSite( $school_id )
    {
        return Site::getItem( $school_id );
    }

}
