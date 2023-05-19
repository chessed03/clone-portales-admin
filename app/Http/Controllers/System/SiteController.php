<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    public function index( Request $request )
    {

        $module    = 'Publicación';

        $submodule = 'Sitios';

        $location  = 'Inicio';

        return view('system.sites.index', [
            'module'    => $module,
            'submodule' => $submodule,
            'location'  => $location
        ]);

    }

    public function create( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Sitios';

        $location     = 'Crear';

        $list_schools = Site::getAliveSchools();

        return view('system.sites.create', [
            'module'       => $module,
            'submodule'    => $submodule,
            'location'     => $location,
            'list_schools' => $list_schools
        ]);

    }

    public function saveCreate( Request $request )
    {
        
        $request->validate([
            'school_id'       => 'required',
            'favicon_url'     => 'required',
            'title'           => 'required',
            'base_url'        => 'required',
            'server_name'     => 'required'
        ]);

        $validateSiteName = Site::validateSiteName( $request->title, null );

        if ( FALSE AND  $validateSiteName ) {

            return redirect()->route('site-index')->with('error', "Ups!, ya existe un sitio con el titulo: $request->title.");

        } else {

            $result = Site::createItem( $request );

            if ($result) {

                return redirect()->route('site-index')->with('success', "Exito!, sitio creado correctamente.");

            } else {

                return redirect()->route('site-index')->with('error', "Ups!, ha ocurrido un error.");

            }

        }

    }

    public function update( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Sitios';

        $location     = 'Editar';

        $list_schools = Site::getAliveSchools();

        $item         = Site::findOrFail( $request->id );

        return view('system.sites.update', [
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
            'school_id'       => 'required',
            'favicon_url'     => 'required',
            'title'           => 'required',
            'base_url'        => 'required',
            'server_name'     => 'required'
        ]);

        $validateSiteName = Site::validateSiteName( $request->title, $request->id );

        if ( FALSE AND $validateSiteName ) {

            return redirect()->route('site-index')->with('error', "Ups!, ya existe un sitio con el titulo: $request->title.");

        } else {

            $result = Site::updateItem( $request );

            if ($result) {

                return redirect()->route('site-index')->with('success', "Exito!, sitio editado correctamente.");

            } else {

                return redirect()->route('site-index')->with('error', "Ups!, ha ocurrido un error.");

            }

        }

    }

}
