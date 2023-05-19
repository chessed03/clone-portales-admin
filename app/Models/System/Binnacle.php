<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Binnacle extends Model
{
    use HasFactory;

    protected $table = 'binnacles';

    protected $fillable = [
        'type',
        'table',
        'description',
        'created_by'
    ];

    public static function binnacleRegister( $type, $table, $object, $id ){

        $description = null;

        if ( $type == 'create' ) {

            $description = "Added a new $object id ($id)";

        }

        if ( $type == 'update' ) {

            $description = "Updated $object id ($id)";

        }

        if ( $type == 'delete' ) {

            $description = "Deleted $object id ($id)";

        }

        Binnacle::create([
            'type'        => $type,
            'table'       => $table,
            'description' => $description,
            'created_by'  => auth()->user()->id."-".auth()->user()->name
        ]);

    }

}
