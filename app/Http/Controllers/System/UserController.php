<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function index( Request $request )
    {

        $module    = 'Configuración';

        $submodule = 'Usuarios';

        return view('system.users.index', [
            'module'    => $module,
            'submodule' => $submodule
        ]);

    }

}
