<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    
    use HasFactory;

    protected $table   = 'notices';

    protected $guarded = [];  

    const TABLE      = "notices";

    const REMOVED    = 0;

    const ALIVE      = 1;

    public function noticeable()
    {

        return $this->morphTo();

    }

    public static function findNoticeById( $id, $modelClass )
    {

        $result = null;
        
        $query = self::where('noticeable_id', $id)
            ->where('noticeable_type', $modelClass)
            ->where('status', self::ALIVE)
            ->first();

        if ( $query ) {

            $result = $query;

        }

        return $result;
        
    }

    public static function launchNoticeById( $itemId, $modelClass, $launchNotice, $itemCreatedBy )
    {

        $query = self::findNoticeById( $itemId , $modelClass );

        if ( is_null( $query ) ) {

            if ( !is_null($launchNotice) ) {
            
                $modelClass::find($itemId)->notices()->create([

                    'created_by' => $itemCreatedBy
    
                ]);

            }

        } else {

            if ( is_null($launchNotice) ) {
            
                $query->status = self::REMOVED;

                $query->update();

            }

        }        

    }

}
