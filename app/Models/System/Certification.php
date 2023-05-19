<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Certification extends Model
{
    use HasFactory;

    protected $table = 'certifications';

    const TABLE      = "certifications";

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

    public static function getAliveCertificationsForView($keyWord, $paginateNumber, $orderBy)
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

    public static function validateCertificationName($name, $id)
    {

        $result = null;

        $query = DB::table(self::TABLE);

        if ($id) {

            $query->where('id', '!=', $id);

        }

        $query->where('name', $name);

        $query->where('status', self::ALIVE);

        $rows = $query->count();

        if ($rows) {

            $result = $rows;

        }

        return $result;

    }

    public static function createItem($data)
    {

        $item              = new self();
        $item->school_id   = $data->school_id;
        $item->name        = $data->name;
        $item->description = $data->description;
        $item->image_url   = $data->image_url;
        $item->created_by  = auth()->user()->id . "-" . auth()->user()->name;


        if ($item->save()) {

            Binnacle::binnacleRegister('create', self::TABLE, 'certification', $item->id);       
                        
            return true;

        }

        return false;

    }

    public static function updateItem($data)
    {

        $item              = self::where('id', $data->id)->first();
        $item->school_id   = $data->school_id;
        $item->name        = $data->name;
        $item->description = $data->description;
        $item->image_url   = $data->image_url;

        if ($item->update()) {

            Binnacle::binnacleRegister('update', self::TABLE, 'certification', $item->id);

            return true;

        }

        return false;
    }

    public static function destroyItem( $id )
    {
        
        $item         = self::where('id', $id)->first();
        $item->status = self::REMOVED;
        
        if ( $item->update() ) {

            Binnacle::binnacleRegister('delete', self::TABLE, 'certification', $item->id);

            return true;

        }

        return false;

    }

}
