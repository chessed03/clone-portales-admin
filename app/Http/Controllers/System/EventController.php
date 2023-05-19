<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function index( Request $request )
    {

        $module    = 'Publicación';

        $submodule = 'Eventos';

        $location  = 'Inicio';

        return view('system.events.index', [
            'module'    => $module,
            'submodule' => $submodule,
            'location'  => $location
        ]);

    }

    public function create( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Eventos';

        $location     = 'Crear';

        $list_schools = Event::getAliveSchools();

        return view('system.events.create', [
            'module'       => $module,
            'submodule'    => $submodule,
            'location'     => $location,
            'list_schools' => $list_schools
        ]);

    }

    public function saveCreate( Request $request )
    {

        $status = $request->status;

        if ( $status ) {

            if ($status == Event::ALIVE) {

                $request->validate([
                    'schools'          => 'required',
                    'name'             => 'required',
                    'slug'             => 'required',
                    'description'      => 'required',
                    'meta_keywords'    => 'required',
                    'status'           => 'required',
                    'start_date'       => 'required|date_format:d/m/Y g:i A',
                    'finish_date'      => 'required|date_format:d/m/Y g:i A',
                    'location'         => 'required',
                    'image_url'        => 'required'
                ]);



            }

            if ($status == Event::PAUSED) {

                $request->validate([
                    'schools' => 'required',
                    'name'    => 'required',
                    'status'  => 'required',
                ]);

            }

            if ( $request->input_has_cost == 1 ) {

                $request->validate([
                    'input_value_price'     => 'required',
                    'select_value_discount' => 'required'
                ]);

            }

            $validateEventName = Event::validateEventName( $request->name, null );

            if ( $validateEventName ) {

                return redirect()->route('event-index')->with('error', "Ups!, ya existe un evento con el nombre: $request->name.");

            } else {

                $result = Event::createItem( $request );

                if ($result) {

                    return redirect()->route('event-index')->with('success', "Exito!, evento creado correctamente.");

                } else {

                    return redirect()->route('event-index')->with('error', "Ups!, ha ocurrido un error.");

                }

            }

        }

        return redirect()->route('event-index')->with('error', "Ups!, ha ocurrido un error.");

    }

    public function update( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Eventos';

        $location     = 'Editar';

        $list_schools = Event::getAliveSchools();

        $item         = Event::findOrFail( $request->id );

        $notice       = Event::findNoticeById( $request->id );

        return view('system.events.update', [
            'module'       => $module,
            'submodule'    => $submodule,
            'location'     => $location,
            'list_schools' => $list_schools,
            'item'         => $item,
            'notice'       => $notice
        ]);

    }

    public function saveUpdate( Request $request )
    {

        $status = $request->status;

        if ( $status ) {

            if ($status == Event::ALIVE) {

                $request->validate([
                    'schools'          => 'required',
                    'name'             => 'required',
                    'slug'             => 'required',
                    'description'      => 'required',
                    'meta_keywords'    => 'required',
                    'status'           => 'required',
                    'start_date'       => 'required|date_format:d/m/Y g:i A',
                    'finish_date'      => 'required|date_format:d/m/Y g:i A',
                    'location'         => 'required',
                    'image_url'        => 'required'
                ]);

            }

            if ($status == Event::PAUSED) {

                $request->validate([
                    'schools' => 'required',
                    'name'    => 'required',
                    'status'  => 'required',
                ]);

            }

            if ( $request->input_has_cost == 1 ) {

                $request->validate([
                    'input_value_price'     => 'required',
                    'select_value_discount' => 'required'
                ]);

            }

            $validateEventName = Event::validateEventName($request->name, $request->id);

            if ($validateEventName) {

                return redirect()->route('event-index')->with('error', "Ups!, ya existe un evento con el nombre: $request->name.");

            } else {
                //dd($request->all());
                $result = Event::updateItem($request);

                if ($result) {

                    return redirect()->route('event-index')->with('success', "Exito!, evento editado correctamente.");

                } else {

                    return redirect()->route('event-index')->with('error', "Ups!, ha ocurrido un error.");

                }

            }

        }

        return redirect()->route('event-index')->with('error', "Ups!, ha ocurrido un error.");

    }

}
