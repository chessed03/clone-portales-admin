<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    use HasFactory;

    protected $table   = 'users';

    const TABLE        = 'users';

    const REMOVED      = 0;

    const ALIVE        = 1;

    const DISCONTINUED = 2;

    public static function getUserById( $id )
    {

        $result = null;

        $query  = self::where('id', auth()->user()->id)
            ->where('status', self::ALIVE)
            ->first();

        if ( $query ) {

            $result = $query;

        }

        return $result;

    }

    public static function getAliveUsers( $keyWord, $paginateNumber, $orderBy )
    {

        $result = null;

        $query = self::whereRaw('id != 1');

        $query->whereRaw('id != ' . auth()->user()->id);

        $query->whereRaw('name LIKE "' . $keyWord . '"');

        if ( $orderBy == 1 ) {

            $query->orderByRaw('name ASC');

        }

        if ( $orderBy == 2 ) {

            $query->orderByRaw('name DESC');

        }

        if ( $orderBy == 3 ) {

            $query->orderByRaw('created_at DESC');

        }

        if ( $orderBy == 4 ) {

            $query->orderByRaw('created_at ASC');

        }

        $query->whereRaw('status = "' . self::ALIVE . '"');

        $result = $query->paginate($paginateNumber);

        return $result;

    }

    public static function getAliveSchools()
    {
        return School::getAliveSchools();
    }

    public static function getAliveSubmodules()
    {

        return Module::getAliveSubmodules();

    }

    public static function validateUserEmail( $email, $id )
    {

        $result = null;

        $query  = DB::table(self::TABLE);

        if ( $id ) {

            $query->where('id', '!=', $id);

        }

        $query->where('email', $email);

        $query->where('status', self::ALIVE);

        $rows = $query->count();

        if ( $rows ) {

            $result = $rows;

        }

        return $result;

    }

    public static function createItem( $data )
    {

        $item             = new self();
        $item->name       = $data->name;
        $item->email      = $data->email;
        $item->password   = Hash::make($data->password);
        $item->created_by = auth()->user()->id."-".auth()->user()->name;

        if( $item->save() ) {

            Binnacle::binnacleRegister( 'create', self::TABLE, 'user', $item->id );

            return true;

        }

        return false;

    }

    public static function updateItem( $data )
    {

        $item          = self::where('id', $data->id)->first();
        $item->name    = $data->name;
        $item->email   = $data->email;

        if ( $data->password ) {

            $item->password = Hash::make($data->password);

        }

        $item->created_by = auth()->user()->id."-".auth()->user()->name;

        if( $item->save() ) {

            Binnacle::binnacleRegister( 'update', self::TABLE, 'user', $item->id );

            return true;

        }

        return false;

    }

    public static function destroyItem( $id )
    {
        
        $item = self::where('id', $id)->first();

        Permission::deletePermissions( $item->id );

        DeletedUser::generateRecord( $item );
        
        if ( $item->delete() ) {

            Binnacle::binnacleRegister('delete', self::TABLE, 'user', $item->id);

            return true;

        }

        return false;

    }

}
