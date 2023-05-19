<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Link extends Model
{

    use HasFactory;

    protected $table = 'links';

    const TABLE      = "links";

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

    public static function getAliveLinksForView($keyWord, $paginateNumber, $orderBy)
    {
        $schools = ___getPermissionUser()->schools;

        $result = null;

        $query = self::whereRaw('status = "' . self::ALIVE . '"');

        $query->where( function( $query ) use ( $keyWord ){
            $query->whereRaw('platform_high_school_students_url LIKE "' . $keyWord . '"')
                  ->orWhereRaw('platform_high_school_teachers_url LIKE "' . $keyWord . '"')
                  ->orWhereRaw('platform_degree_students_url LIKE "' . $keyWord . '"')
                  ->orWhereRaw('platform_degree_teachers_url LIKE "' . $keyWord . '"');
        });

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

    public static function createItem($data)
    {

        $item                                    = new self();
        $item->school_id                         = $data->school_id;
        $item->platform_high_school_students_url = $data->platform_high_school_students_url;
        $item->platform_high_school_teachers_url = $data->platform_high_school_teachers_url;
        $item->platform_degree_students_url      = $data->platform_degree_students_url;
        $item->platform_degree_teachers_url      = $data->platform_degree_teachers_url;
        $item->created_by                        = auth()->user()->id . "-" . auth()->user()->name;

        if ( $data->platform_high_school_students_url || $data->platform_high_school_teachers_url || $data->platform_degree_students_url || $data->platform_degree_teachers_url ) {

            if ($item->save()) {

                Binnacle::binnacleRegister('create', self::TABLE, 'link', $item->id);

                return true;

            }

        }

        return false;

    }

    public static function updateItem($data)
    {

        $item                                    = self::where('id', $data->id)->first();
        $item->school_id                         = $data->school_id;
        $item->platform_high_school_students_url = $data->platform_high_school_students_url;
        $item->platform_high_school_teachers_url = $data->platform_high_school_teachers_url;
        $item->platform_degree_students_url      = $data->platform_degree_students_url;
        $item->platform_degree_teachers_url      = $data->platform_degree_teachers_url;

        if ( $data->platform_high_school_students_url || $data->platform_high_school_teachers_url || $data->platform_degree_students_url || $data->platform_degree_teachers_url ) {

            if ($item->update()) {

                Binnacle::binnacleRegister('update', self::TABLE, 'link', $item->id);

                return true;


            }

        }

        return false;
    }

    public static function destroyItem( $id )
    {

        $item         = self::where('id', $id)->first();
        $item->status = self::REMOVED;

        if ( $item->update() ) {

            Binnacle::binnacleRegister('delete', self::TABLE, 'link', $item->id);

            return true;

        }

        return false;

    }

}
