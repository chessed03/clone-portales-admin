<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CarouselImage extends Model
{
    use HasFactory;

    protected $table = 'carousel_images';

    const TABLE      = "carousel_images";

    protected $casts = [
        'schools' => 'json'
    ];

    const REMOVED    = 0;

    const ALIVE      = 1;

    public function dataSchool()
    {
        return $this->belongsTo(School::class, 'school_id')->where('status', School::ALIVE);
    }

    public static function getAliveItemBySchoolId( $id )
    {

        if ( $id ) {

            $query =  self::whereJsonContains('schools', $id);

            $query->where( 'status', self::ALIVE );

            if ( $query->first() ) {

                return true;

            }

        }

        return false;

    }

    public static function getAliveImagesForView( $keyWord, $paginateNumber, $orderBy )
    {
        $result = null;

        $query = self::whereRaw('carousel_images.status = "' . self::ALIVE . '"');

        $query->where( function( $query ) use ( $keyWord ){
            $query->whereRaw('carousel_images.name LIKE "' . $keyWord . '"');
        });

        if ( $orderBy == 1 ) {

            $query->orderByRaw('carousel_images.name ASC');

        }

        if ( $orderBy == 2 ) {

            $query->orderByRaw('carousel_images.name DESC');

        }

        if ( $orderBy == 3 ) {

            $query->orderByRaw('carousel_images.created_at DESC');

        }

        if ( $orderBy == 4 ) {

            $query->orderByRaw('carousel_images.created_at ASC');

        }

        $result = $query->paginate($paginateNumber);

        return $result;
    }

    public static function getAliveSchools()
    {
        $shoolsPermissions = ___getPermissionUser()->write;

        return School::getAliveSchoolsByArrayId( $shoolsPermissions );
    }

    public static function getAliveSites()
    {
        $shoolsPermissions = ___getPermissionUser()->write;

        return Site::getAliveSitesByArrayId( $shoolsPermissions );
    }

    public static function validateImageName( $titulo, $id )
    {

        $result = null;

        $query  = DB::table(self::TABLE);

        if ( $id ) {

            $query->where('id', '!=', $id);

        }

        $query->where('title', $titulo);

        $query->where('status', self::ALIVE);

        $rows = $query->count();

        if ( $rows ) {

            $result = $rows;

        }

        return $result;

    }

    public static function createItem( $data )
    {

        $item                  = new self();
        $item->schools         = $data->schools;
        $item->name            = $data->name;
        $item->image_url       = $data->image_url;
        $item->content         = $data->content ?? '';
        $item->image_movil_url = $data->image_movil_url;
        $item->content_movil   = $data->content_movil ?? '';
        $item->created_by      = auth()->user()->id."-".auth()->user()->name;


        if( $item->save() ) {

            Binnacle::binnacleRegister( 'create', self::TABLE, 'carousel image', $item->id );

            return true;

        }

        return false;
    }

    public static function updateItem( $data )
    {

        $item                  = self::where('id', $data->id)->first();
        $item->schools         = $data->schools;
        $item->name            = $data->name;
        $item->image_url       = $data->image_url;
        $item->content         = $data->content ?? '';
        $item->image_movil_url = $data->image_movil_url;
        $item->content_movil   = $data->content_movil ?? '';

        if( $item->update() ) {

            Binnacle::binnacleRegister( 'update', self::TABLE, 'carousel image', $item->id );

            return true;

        }

        return false;
    }

    public static function destroyItem( $id )
    {

        $item         = self::where('id', $id)->first();
        $item->status = self::REMOVED;

        if ( $item->update() ) {

            Binnacle::binnacleRegister('delete', self::TABLE, 'carousel image', $item->id);

            return true;

        }

        return false;

    }

}
