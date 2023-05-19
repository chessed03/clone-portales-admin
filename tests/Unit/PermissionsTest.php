<?php

namespace Tests\Unit;

use App\Models\System\Permission;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class PermissionsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_permissions()
    {
        $user_id     = 1;

        $permissions = Permission::find( $user_id );

        $new_item = "7";

        $new_permissions = [];

        foreach ( $permissions->permissions as $p => $permission ) {

            array_push($permission['write'], $new_item);

            $new_permissions[$p] = [
                'read'      => $permission['read'],
                'write'     => $permission['write'],
                'module_id' => $permission['module_id']
            ];


        }

        dd($new_permissions);
    }
}
