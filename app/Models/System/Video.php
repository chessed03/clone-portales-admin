<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Video extends Model
{
    
    use HasFactory;

    protected $table  = 'videos';

    const TABLE       = 'videos';

    const REMOVED     = 0;

    const ALIVE       = 1;

    const INACTIVATED = 2;

    public function dataSchool()
    {
        return $this->belongsTo(School::class, 'school_id')->where('status', School::ALIVE);
    }

    public static function getAliveItemBySchoolId( $id )
    {

        if ( $id ) {

            $query = self::where( 'school_id', $id )
                ->where( 'status', self::ALIVE )
                ->first();

            if ( $query ) {

                return true;

            }

        }

        return false;

    }

    public static function getAliveVideosForView( $keyWord, $paginateNumber, $orderBy )
    {

        $result = null;        

        $query = self::whereRaw('name LIKE "' . $keyWord . '"');

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

        $query->whereRaw('status != "' . self::REMOVED . '"');

        $result = $query->paginate($paginateNumber);

        return $result;

    }

    public static function getAliveSchools()
    {
        $shoolsPermissions = ___getPermissionUser()->write;

        return School::getAliveSchoolsByArrayId( $shoolsPermissions );
    }

    public static function createItem($data)
    {

        $item             = new self();
        $item->school_id  = $data->school_id;
        $item->name       = $data->name;
        $item->video_url  = $data->video_url;
        $item->image_url  = $data->image_url;
        $item->created_by = auth()->user()->id . "-" . auth()->user()->name;


        if ($item->save()) {

            Binnacle::binnacleRegister('create', self::TABLE, 'video', $item->id);
            
            self::where('school_id', $item->school_id)
                ->where('id', '!=', $item->id)
                ->where('status', '!=', self::REMOVED)
                ->update([
                    'status' => self::INACTIVATED
                ]);
                        
            return true;

        }

        return false;

    }

    public static function updateItem($data)
    {

        $item             = self::where('id', $data->id)->first();
        $item->school_id  = $data->school_id;
        $item->name       = $data->name;
        $item->video_url  = $data->video_url;
        $item->image_url  = $data->image_url;

        if ($item->update()) {

            Binnacle::binnacleRegister('update', self::TABLE, 'video', $item->id);

            return true;

        }

        return false;
    }

    public static function setActiveStatus( $id )
    {
        
        $item = self::where('id', $id)->first();

        $item->status = self::ALIVE;

        if ( $item->update() ) {

            Binnacle::binnacleRegister('update', self::TABLE, 'video', $item->id);
            
            self::where('school_id', $item->school_id)
                ->where('id', '!=', $item->id)
                ->where('status', '!=', self::REMOVED)
                ->update([
                    'status' => self::INACTIVATED
                ]);
                        
            return true;

        }

    }

    public static function destroyItem( $id )
    {
        
        $item         = self::where('id', $id)->first();
        $item->status = self::REMOVED;
        
        if ( $item->update() ) {

            Binnacle::binnacleRegister('delete', self::TABLE, 'video', $item->id);

            return true;

        }

        return false;

    }


}
