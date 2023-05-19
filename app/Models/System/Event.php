<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Event extends Model
{

    use HasFactory;

    protected $table = 'events';

    protected $casts = [
        'schools' => 'json'
    ];

    const TABLE      = "events";

    const REMOVED    = 0;

    const ALIVE      = 1;

    const PAUSED     = 2;

    public function notices()
    {

        return $this->morphMany(Notice::class, 'noticeable');

    }

    public static function findNoticeById( $id )
    {

        return Notice::findNoticeById( $id , self::class );

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

    public static function getAliveEventsForView($keyWord, $paginateNumber, $orderBy)
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

    public static function validateEventName($name, $id)
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

    protected static function generateUuid()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }

    public static function createItem($data)
    {

        $item                   = new self();
        $item->schools          = $data->schools;
        $item->name             = $data->name;
        $item->slug             = $data->slug;
        $item->description      = $data->description;
        $item->meta_keywords    = $data->meta_keywords;
        $item->start_date       = ( $data->start_date ) ? Carbon::createFromFormat('d/m/Y g:i A', $data->start_date) : null;
        $item->finish_date      = ( $data->finish_date ) ? Carbon::createFromFormat('d/m/Y g:i A', $data->finish_date) : null;
        $item->location         = $data->location;
        $item->image_url        = $data->image_url;
        $item->has_cost         = intval($data->input_has_cost);
        $item->price            = $data->input_value_price;
        $item->discount         = $data->select_value_discount;
        $item->uuid             = self::generateUuid();
        $item->status           = $data->status;
        $item->created_by       = auth()->user()->id . "-" . auth()->user()->name;


        if ($item->save()) {

            Binnacle::binnacleRegister('create', self::TABLE, 'event', $item->id);

            if ( $item->status == 1 ) {

                $deskServiceEndPoint = (object)[
                    'key_id'      => $item->id,
                    'uuid'        => $item->uuid,
                    'code_school' => json_encode($item->schools),
                    'code_type'   => 'eventos',
                    'name'        => $item->name,
                    'description' => $item->description,
                    'price'       => $item->price,
                    'discount'    => $item->discount,
                    'date'        => Carbon::createFromDate($item->start_date)->format('Y-m-d')
                ];

                $sendData = __consumeEndPoint('dataCreateCashRegister', $deskServiceEndPoint); // dd(json_decode($sendData->original['data']));

            }


            if ( !is_null($data->launch_notice) ) {

                self::find($item->id)->notices()->create([

                    'start_date' => $item->start_date,
                    'created_by' => $item->created_by

                ]);

            }

            return true;

        }

        return false;

    }

    public static function updateItem($data)
    {

        $item                   = self::where('id', $data->id)->first();
        $item->schools          = $data->schools;
        $item->name             = $data->name;
        $item->slug             = $data->slug;
        $item->description      = $data->description;
        $item->meta_keywords    = $data->meta_keywords;
        $item->start_date       = ( $data->start_date ) ? Carbon::createFromFormat('d/m/Y g:i A', $data->start_date) : null;
        $item->finish_date      = ( $data->finish_date ) ? Carbon::createFromFormat('d/m/Y g:i A', $data->finish_date) : null;
        $item->location         = $data->location;
        $item->image_url        = $data->image_url;
        $item->has_cost         = intval($data->input_has_cost);
        $item->price            = ( intval($data->input_has_cost) == 1 ) ? $data->input_value_price : 0;
        $item->discount         = ( intval($data->input_has_cost) == 1 ) ? $data->select_value_discount : 0;
        $item->uuid             = $item->uuid ?? self::generateUuid();
        $item->status           = $data->status;

        if ($item->update()) {

            Binnacle::binnacleRegister('update', self::TABLE, 'event', $item->id);

            if ( $item->status == 1 ) {

                $deskServiceEndPoint = (object)[
                    'key_id'      => $item->id,
                    'uuid'        => $item->uuid,
                    'code_school' => json_encode($item->schools),
                    'code_type'   => 'eventos',
                    'name'        => $item->name,
                    'description' => $item->description,
                    'price'       => $item->price,
                    'discount'    => $item->discount,
                    'date'        => Carbon::createFromDate($item->start_date)->format('Y-m-d')
                ];

                $sendData = __consumeEndPoint('dataUpdateCashRegister', $deskServiceEndPoint); // dd(json_decode($sendData->original['data']));

            }

            $notice = $item->notices()
                ->where('noticeable_id', $data->id)
                ->where('noticeable_type', self::class)
                ->first();

            if ( is_null( $notice ) ) {

                if ( !is_null($data->launch_notice) ) {

                    self::find($item->id)->notices()->create([

                        'start_date' => $item->start_date,
                        'created_by' => $item->created_by

                    ]);

                }

            } else {

                $notice->status     = ( is_null($data->launch_notice) ) ? self::REMOVED : self::ALIVE ;

                $notice->start_date = $item->start_date;

                $notice->update();

            }

            return true;

        }

        return false;
    }

    public static function destroyItem( $id )
    {

        $item         = self::where('id', $id)->first();
        $item->status = self::REMOVED;

        if ( $item->update() ) {

            Binnacle::binnacleRegister('delete', self::TABLE, 'event', $item->id);

            $notice = $item->notices()
                ->where('noticeable_id', $item->id)
                ->where('noticeable_type', self::class)
                ->where('status', '!=', self::REMOVED)
                ->first();

            if ( $notice ) {

                $notice->status = self::REMOVED;

                $notice->update();

            }

            return true;

        }

        return false;

    }

}
