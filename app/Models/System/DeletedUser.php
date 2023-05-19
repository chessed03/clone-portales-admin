<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeletedUser extends Model
{
 
    use HasFactory;

    protected $table   = 'deleted_users';

    protected $casts   = [
        'schools'  => 'json'
    ];

    const TABLE        = 'deleted_users';

    const REMOVED      = 0;

    const ALIVE        = 1;

    const DISCONTINUED = 2;

    public static function generateRecord( $data )
    {
        $item                     = new self();
        $item->user_id            = $data->id;
        $item->figure_id          = $data->figure_id;
        $item->user_name          = $data->user_name;
        $item->name               = $data->name;
        $item->email              = $data->email;
        $item->email_verified_at  = $data->email_verified_at;
        $item->password           = $data->password;
        $item->created_by         = auth()->user()->id . "-" . auth()->user()->name;


        if ($item->save()) {

            Binnacle::binnacleRegister('create', self::TABLE, 'deleted user', $item->user_id);
                        
            return true;

        }

        return false;
    }

}
