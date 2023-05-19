<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerOneInformation extends Model
{
    use HasFactory;

    protected $table  = 'banner_one_informations';

    const TABLE       = 'banner_one_informations';

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

    public static function getAliveBannerOneInformationsForView( $keyWord, $paginateNumber, $orderBy )
    {

        $result = null;  
        
        $query = self::whereRaw('status != "' . self::REMOVED . '"');

        $query->where( function( $query ) use ( $keyWord ){
            $query->whereRaw('title LIKE "' . $keyWord . '"')
                  ->orWhereRaw('subtitle LIKE "' . $keyWord . '"');
        });

        if ( $orderBy == 1 ) {

            $query->orderByRaw('title ASC');

        }

        if ( $orderBy == 2 ) {

            $query->orderByRaw('title DESC');

        }

        if ( $orderBy == 3 ) {

            $query->orderByRaw('created_at DESC');

        }

        if ( $orderBy == 4 ) {

            $query->orderByRaw('created_at ASC');

        }

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

        $item                         = new self();
        $item->school_id              = $data->school_id;
        $item->title                  = $data->title;
        $item->subtitle               = $data->subtitle;
        $item->title_quality_one      = $data->title_quality_one;
        $item->subtitle_quality_one   = $data->subtitle_quality_one;
        $item->icon_quality_one       = $data->icon_quality_one;
        $item->title_quality_two      = $data->title_quality_two;
        $item->subtitle_quality_two   = $data->subtitle_quality_two;
        $item->icon_quality_two       = $data->icon_quality_two;
        $item->title_quality_three    = $data->title_quality_three;
        $item->subtitle_quality_three = $data->subtitle_quality_three;
        $item->icon_quality_three     = $data->icon_quality_three;
        $item->image_url              = $data->image_url;
        $item->created_by             = auth()->user()->id . "-" . auth()->user()->name;


        if ($item->save()) {

            Binnacle::binnacleRegister('create', self::TABLE, 'banner one information', $item->id);
            
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

        $item                         = self::where('id', $data->id)->first();
        $item->school_id              = $data->school_id;
        $item->title                  = $data->title;
        $item->subtitle               = $data->subtitle;
        $item->title_quality_one      = $data->title_quality_one;
        $item->subtitle_quality_one   = $data->subtitle_quality_one;
        $item->icon_quality_one       = $data->icon_quality_one;
        $item->title_quality_two      = $data->title_quality_two;
        $item->subtitle_quality_two   = $data->subtitle_quality_two;
        $item->icon_quality_two       = $data->icon_quality_two;
        $item->title_quality_three    = $data->title_quality_three;
        $item->subtitle_quality_three = $data->subtitle_quality_three;
        $item->icon_quality_three     = $data->icon_quality_three;
        $item->image_url              = $data->image_url;

        if ($item->update()) {

            Binnacle::binnacleRegister('update', self::TABLE, 'banner one information', $item->id);

            return true;

        }

        return false;
    }

    public static function setActiveStatus( $id )
    {
        
        $item = self::where('id', $id)->first();

        $item->status = self::ALIVE;

        if ( $item->update() ) {

            Binnacle::binnacleRegister('update', self::TABLE, 'banner one information', $item->id);
            
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

            Binnacle::binnacleRegister('delete', self::TABLE, 'banner one information', $item->id);

            return true;

        }

        return false;

    }
}
