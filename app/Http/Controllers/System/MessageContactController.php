<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\MessageContact;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MessageContactsExport;
use Illuminate\Http\Request;

class MessageContactController extends Controller
{

    public function index( Request $request )
    {

        $module    = 'Publicación';

        $submodule = 'Mensajes de contactos';

        $location  = 'Inicio';

        return view('system.message-contacts.index', [
            'module'    => $module,
            'submodule' => $submodule,
            'location'  => $location
        ]);

    }

    public function generateExcel( Request $request )
    {

        $typeMessage           = intval($request->typeMessage);

        $getItemsByTypeMessage = MessageContact::getItemsByTypeMessage( $typeMessage );

        return Excel::download(new MessageContactsExport($getItemsByTypeMessage), 'mensajes-de-contactos.xlsx');

    }

}
