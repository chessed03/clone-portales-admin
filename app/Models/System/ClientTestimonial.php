<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientTestimonial extends Model
{
    use HasFactory;

    protected $table = 'client_testimonials';

    const TABLE      = "client_testimonials";

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

    public static function getAliveClientTestimonialsForView($keyWord, $paginateNumber, $orderBy)
    {
        $schools = ___getPermissionUser()->schools;

        $result = null;

        $query = self::whereRaw('status = "' . self::ALIVE . '"');

        $query->whereRaw('name LIKE "' . $keyWord . '"');

        if ($orderBy == 1) {

            $query->orderByRaw('name ASC');

        }

        if ($orderBy == 2) {

            $query->orderByRaw('name DESC');

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

    public static function createItem($data)
    {

        $item             = new self();
        $item->school_id  = $data->school_id;
        $item->name       = $data->name;
        $item->profession = $data->profession;
        $item->comments   = $data->comments;
        $item->image_url  = $data->image_url;
        $item->created_by = auth()->user()->id . "-" . auth()->user()->name;


        if ($item->save()) {

            Binnacle::binnacleRegister('create', self::TABLE, 'client comments', $item->id);

            return true;

        }

        return false;

    }

    public static function updateItem($data)
    {

        $item             = self::where('id', $data->id)->first();
        $item->school_id  = $data->school_id;
        $item->name       = $data->name;
        $item->profession = $data->profession;
        $item->comments   = $data->comments;
        $item->image_url  = $data->image_url;

        if ($item->update()) {

            Binnacle::binnacleRegister('update', self::TABLE, 'client comments', $item->id);

            return true;


        }

        return false;
    }

    public static function destroyItem( $id )
    {

        $item         = self::where('id', $id)->first();
        $item->status = self::REMOVED;

        if ( $item->update() ) {

            Binnacle::binnacleRegister('delete', self::TABLE, 'client comments', $item->id);

            return true;

        }

        return false;

    }

}
