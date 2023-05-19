<?php

namespace App\Models\System;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class MessageContact extends Model
{

    use HasFactory;

    protected $table = 'message_contacts';

    const TABLE      = "message_contacts";

    const REMOVED    = 0;

    const ALIVE      = 1; // No leidos

    const PAUSED     = 2; // Leidos

    public function dataSchool()
    {
        return $this->belongsTo(School::class, 'school_id')->where('status', School::ALIVE);
    }

    public static function getAliveMessageContactsForView($keyWord, $typeMessage, $paginateNumber, $orderBy)
    {
        $schools = ___getPermissionUser()->schools;

        $result = null;

        if ( $typeMessage == 3 ) {

            $query = self::whereRaw('status != "' . self::REMOVED . '"');

        } else {

            $query = self::whereRaw('status = "' . $typeMessage . '"');

        }

        $query->whereIn('school_id', $schools);

        $query->where( function( $query ) use ( $keyWord ){
            $query->whereRaw('name LIKE "' . $keyWord . '"')
                  ->orWhereRaw('email LIKE "' . $keyWord . '"')
                  ->orWhereRaw('phone LIKE "' . $keyWord . '"');
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

    public static function messageReadItem( $id )
    {

        $item         = self::where('id', $id)->first();
        $item->status = self::PAUSED;

        if ( $item->update() ) {

            Binnacle::binnacleRegister('update', self::TABLE, 'message contact', $item->id);

            return true;

        }

        return false;

    }

    public static function getItemsByTypeMessage( $typeMessage )
    {
        $result = null;

        if ( $typeMessage ) {

            if ( $typeMessage == 3 ) {

                $query = self::where('status', '!=', self::REMOVED);

            } else {

                $query = self::where('status', $typeMessage);

            }

            $collection = $query->get();

            if ( $collection ) {

                foreach ( $collection as $key => $item ) {

                    $data[$key] = (object)[
                        'np'         => intval($key + 1),
                        'name'       => $item->name,
                        'email'      => $item->email,
                        'phone'      => $item->phone,
                        'status'     => ( $item->status == 1 ) ? 'No líedo' : 'Leído',
                        'date'       => Carbon::createFromDate( $item->created_at )->isoFormat('LL'),
                        'school'     => $item->dataSchool->name,
                        'message'    => $item->message,
                        'way_access' => $item->way_access
                    ];

                }

                $result = Collection::make($data);

            }

        }

        return $result;

    }

}
