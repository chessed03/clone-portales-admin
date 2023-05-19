<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    
    public function index( Request $request )
    {

        $module    = 'Publicación';

        $submodule = 'Enlaces';

        $location  = 'Inicio';

        return view('system.links.index', [
            'module'    => $module,
            'submodule' => $submodule,
            'location'  => $location
        ]);

    }

    public function create( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Enlaces';

        $location     = 'Crear';

        $list_schools = Link::getAliveSchools();

        return view('system.links.create', [
            'module'       => $module,
            'submodule'    => $submodule,
            'location'     => $location,
            'list_schools' => $list_schools
        ]);

    }

    public function saveCreate( Request $request )
    {

        $request->validate([
            'school_id'   => 'required',
        ]);
                
        $result = Link::createItem( $request );

        if ($result) {

            return redirect()->route('link-index')->with('success', "Exito!, programa creado correctamente.");

        } else {

            return redirect()->route('link-index')->with('error', "Ups!, ha ocurrido un error.");

        }

    }

    public function update( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Enlaces';

        $location     = 'Editar';

        $list_schools = Link::getAliveSchools();

        $item         = Link::findOrFail( $request->id );
        
        return view('system.links.update', [
            'module'       => $module,
            'submodule'    => $submodule,
            'location'     => $location,
            'list_schools' => $list_schools,
            'item'         => $item
        ]);

    }

    public function saveUpdate( Request $request )
    {
        
        $request->validate([
            'school_id'   => 'required'
        ]);
        
        $result = Link::updateItem( $request );

        if ($result) {

            return redirect()->route('link-index')->with('success', "Exito!, programa editado correctamente.");

        } else {

            return redirect()->route('link-index')->with('error', "Ups!, ha ocurrido un error.");

        }

    }

}
