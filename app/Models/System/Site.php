<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Site extends Model
{

    use HasFactory;

    protected $table = 'sites';

    const TABLE      = "sites";

    const REMOVED    = 0;

    const ALIVE      = 1;

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

    public static function getAliveSitesForView( $keyWord, $paginateNumber, $orderBy )
    {

        $result = null;

        $query = self::whereRaw('status = "' . self::ALIVE . '"');

        $query->where( function( $query ) use ( $keyWord ){
            $query->whereRaw('title LIKE "' . $keyWord . '"')
                  ->orWhereRaw('base_url LIKE "' . $keyWord . '"')
                  ->orWhereRaw('server_name LIKE "' . $keyWord . '"');
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

    public static function getAliveSitesByArrayId( $schools )
    {

        $result      = null;

        $query       = self::whereIn('school_id', $schools)
            ->where('status', self::ALIVE)
            ->get();

        if ( $query ) {

            $result = $query;

        }

        return $result;

    }

    public static function validateSiteName( $titulo, $id )
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
        $item->school_id       = $data->school_id;
        $item->favicon_url     = $data->favicon_url;
        $item->title           = $data->title;
        $item->base_url        = $data->base_url;
        $item->server_name     = $data->server_name;
        $item->primary_color   = $data->primary_color;
        $item->secondary_color = $data->secondary_color;
        $item->created_by      = auth()->user()->id."-".auth()->user()->name;

        if( $item->save() ) {

            Binnacle::binnacleRegister( 'create', self::TABLE, 'site', $item->id );

            return true;


        }

        return false;
    }

    public static function updateItem( $data )
    {

        $item                  = self::where('id', $data->id)->first();
        $item->school_id       = $data->school_id;
        $item->favicon_url     = $data->favicon_url;
        $item->title           = $data->title;
        $item->base_url        = $data->base_url;
        $item->server_name     = $data->server_name;
        $item->primary_color   = $data->primary_color;
        $item->secondary_color = $data->secondary_color;

        if( $item->update() ) {

            Binnacle::binnacleRegister( 'update', self::TABLE, 'site', $item->id );

            return true;


        }

        return false;
    }

    public static function validateDestroy( $id )
    {

        $result = false;

        $models = [
            'App\Models\System\CarouselImage'
        ];

        foreach ( $models as $model) {

            $model_name      = app($model);

            $query           = $model_name::getAliveItemBySiteId( $id );

            $located         = '';

            $substring_model = substr( $model, 18 );

            if ($substring_model == "CarouselImage") {

                $located = 'Carrusel de imágenes';

            }

            if ( $query ) {

                $result = (object)[
                    'status'  => true,
                    'located' => $located
                ];

            }

        }

        return $result;

    }

    public static function destroyItem( $id )
    {

        $item         = self::where('id', $id)->first();
        $item->status = self::REMOVED;

        if ( $item->update() ) {

            Binnacle::binnacleRegister('delete', self::TABLE, 'site', $item->id);

            return true;

        }

        return false;

    }

    public static function getItem( $school_id )
    {

        $result = null;

        if ( $school_id ) {

            $query = self::where('school_id', $school_id)
                ->where('status', self::ALIVE)
                ->first();

            if ( $query ) {

                $result = $query;

            }

        }

        return $result;

    }

}
