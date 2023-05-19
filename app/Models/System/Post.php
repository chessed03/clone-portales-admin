<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $casts = [
        'schools' => 'json'
    ];

    const TABLE      = "posts";

    const REMOVED    = 0;

    const ALIVE      = 1;

    const PAUSED     = 2;

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

    public static function getAlivePostsForView($keyWord, $paginateNumber, $orderBy)
    {
        $schools = ___getPermissionUser()->schools;

        $result = null;

        $query = DB::table(self::TABLE);

        $query->where(function ($q) use ($schools) {

            foreach ($schools as $school_id) {

                $q->orWhereJsonContains('schools', $school_id);

            }

        });

        $query->whereRaw('status != "' . self::REMOVED . '"');

        $query->where( function( $query ) use ( $keyWord ){
            $query->whereRaw('title LIKE "' . $keyWord . '"')
                  ->orWhereRaw('subtitle LIKE "' . $keyWord . '"');
        });

        if ($orderBy == 1) {

            $query->orderByRaw('title ASC');

        }

        if ($orderBy == 2) {

            $query->orderByRaw('title DESC');

        }

        if ($orderBy == 3) {

            $query->orderByRaw('created_at DESC');

        }

        if ($orderBy == 4) {

            $query->orderByRaw('created_at ASC');

        }

        $collection = $query->paginate($paginateNumber);

        if ($collection) {

            $result = $collection;

        }

        return $result;
    }

    public static function getAliveSchools()
    {
        $shoolsPermissions = ___getPermissionUser()->write;

        return School::getAliveSchoolsByArrayId($shoolsPermissions);
    }

    public static function validatePostTitle($titulo, $id)
    {

        $result = null;

        $query = DB::table(self::TABLE);

        if ($id) {

            $query->where('id', '!=', $id);

        }

        $query->where('title', $titulo);

        $query->where('status', self::ALIVE);

        $rows = $query->count();

        if ($rows) {

            $result = $rows;

        }

        return $result;

    }

    public static function createItem($data)
    {

        $item                    = new self();
        $item->title             = $data->title;
        $item->slug              = $data->slug;
        $item->subtitle          = $data->subtitle;
        $item->schools           = $data->schools;
        $item->meta_keywords     = $data->meta_keywords;
        $item->content           = $data->content;
        $item->image_feature_url = $data->image_feature_url;
        $item->status            = $data->status;
        $item->created_by        = auth()->user()->id . "-" . auth()->user()->name;


        if ($item->save()) {

            Binnacle::binnacleRegister('create', self::TABLE, 'post', $item->id);

            return true;


        }

        return false;
    }

    public static function updateItem($data)
    {

        $item                    = self::where('id', $data->id)->first();
        $item->title             = $data->title;
        $item->slug              = $data->slug;
        $item->subtitle          = $data->subtitle;
        $item->schools           = $data->schools;
        $item->meta_keywords     = $data->meta_keywords;
        $item->content           = $data->content;
        $item->image_feature_url = $data->image_feature_url;
        $item->status            = $data->status;

        if ($item->update()) {

            Binnacle::binnacleRegister('update', self::TABLE, 'post', $item->id);

            return true;


        }

        return false;
    }

    public static function getPostById( $id )
    {

        $result = null;

        if ( $id ) {

            $query = self::find( $id );

            if ( $query ) {

                $result = $query;

            }

        }

        return $result;

    }

    public static function destroyItem( $id )
    {

        $item         = self::where('id', $id)->first();
        $item->status = self::REMOVED;

        if ( $item->update() ) {

            Binnacle::binnacleRegister('delete', self::TABLE, 'post', $item->id);

            return true;

        }

        return false;

    }

}
