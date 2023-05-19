<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FaqQuestion extends Model
{

    use HasFactory;

    protected $table = 'faq_questions';

    const TABLE      = "faq_questions";

    const REMOVED    = 0;

    const ALIVE      = 1;

    public function dataSchool()
    {
        return $this->belongsTo(School::class, 'school_id');
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

    public static function getAliveFaqQuestionsForView($keyWord, $paginateNumber, $orderBy)
    {
        $schools = ___getPermissionUser()->schools;

        $result = null;

        $query = self::whereRaw('status = "' . self::ALIVE . '"');

        $query->whereRaw('question LIKE "' . $keyWord . '"');

        if ($orderBy == 1) {

            $query->orderByRaw('question ASC');

        }

        if ($orderBy == 2) {

            $query->orderByRaw('question DESC');

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
        $item->question   = $data->question;
        $item->answer     = $data->answer;
        $item->created_by = auth()->user()->id . "-" . auth()->user()->name;


        if ($item->save()) {

            Binnacle::binnacleRegister('create', self::TABLE, 'faq question', $item->id);
                        
            return true;

        }

        return false;

    }

    public static function updateItem($data)
    {

        $item             = self::where('id', $data->id)->first();
        $item->school_id  = $data->school_id;
        $item->question   = $data->question;
        $item->answer     = $data->answer;

        if ($item->update()) {

            Binnacle::binnacleRegister('update', self::TABLE, 'faq question', $item->id);

            return true;


        }

        return false;
    }

    public static function destroyItem( $id )
    {
        
        $item         = self::where('id', $id)->first();
        $item->status = self::REMOVED;
        
        if ( $item->update() ) {

            Binnacle::binnacleRegister('delete', self::TABLE, 'faq question', $item->id);

            return true;

        }

        return false;

    }


}
