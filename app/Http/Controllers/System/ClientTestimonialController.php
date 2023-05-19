<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\ClientTestimonial;
use Illuminate\Http\Request;

class ClientTestimonialController extends Controller
{
    public function index( Request $request )
    {

        $module    = 'Publicación';

        $submodule = 'Comentarios de clientes';

        $location  = 'Inicio';

        return view('system.client-testimonials.index', [
            'module'    => $module,
            'submodule' => $submodule,
            'location'  => $location
        ]);

    }

    public function create( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Comentarios de clientes';

        $location     = 'Crear';

        $list_schools = ClientTestimonial::getAliveSchools();

        return view('system.client-testimonials.create', [
            'module'       => $module,
            'submodule'    => $submodule,
            'location'     => $location,
            'list_schools' => $list_schools
        ]);

    }

    public function saveCreate( Request $request )
    {

        $request->validate([
            'school_id'  => 'required',
            'name'       => 'required',
            'profession' => 'required',
            'comments'   => 'required',
        ]);

        $result = ClientTestimonial::createItem( $request );

        if ( $result ) {

            return redirect()->route('clientTestimonial-index')->with('success', "Exito!, Comentarios creados correctamente.");

        } else {

            return redirect()->route('clientTestimonial-index')->with('error', "Ups!, ha ocurrido un error.");

        }

    }

    public function update( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Comentarios de clientes';

        $location     = 'Editar';

        $list_schools = ClientTestimonial::getAliveSchools();

        $item         = ClientTestimonial::findOrFail( $request->id );

        return view('system.client-testimonials.update', [
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
            'school_id'  => 'required',
            'name'       => 'required',
            'profession' => 'required',
            'comments'   => 'required',
        ]);

        $result = ClientTestimonial::updateItem( $request );

        if ($result) {

            return redirect()->route('clientTestimonial-index')->with('success', "Exito!, Comentarios editados correctamente.");

        } else {

            return redirect()->route('clientTestimonial-index')->with('error', "Ups!, ha ocurrido un error.");

        }

    }
}
