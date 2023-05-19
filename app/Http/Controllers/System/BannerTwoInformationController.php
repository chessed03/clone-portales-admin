<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\BannerTwoInformation;
use Illuminate\Http\Request;

class BannerTwoInformationController extends Controller
{
    public function index( Request $request )
    {

        $module    = 'Publicación';

        $submodule = 'Cinta Informativa 2';

        $location  = 'Inicio';

        return view('system.banner-two-informations.index', [
            'module'    => $module,
            'submodule' => $submodule,
            'location'  => $location
        ]);

    }

    public function create( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Cinta Informativa 2';

        $location     = 'Crear';

        $list_schools = BannerTwoInformation::getAliveSchools();

        return view('system.banner-two-informations.create', [
            'module'       => $module,
            'submodule'    => $submodule,
            'location'     => $location,
            'list_schools' => $list_schools
        ]);

    }

    public function saveCreate( Request $request )
    {

        $request->validate([
            'school_id'            => 'required',
            'title'                => 'required',
            'subtitle'             => 'required',
            'image_url'            => 'required'
        ]);
        
        $result = BannerTwoInformation::createItem( $request );

        if ( $result ) {

            return redirect()->route('bannerTwoInformation-index')->with('success', "Exito!, Información creada correctamente.");

        } else {

            return redirect()->route('bannerTwoInformation-index')->with('error', "Ups!, ha ocurrido un error.");

        }

    }

    public function update( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Cinta Informativa 2';

        $location     = 'Editar';

        $list_schools = BannerTwoInformation::getAliveSchools();

        $item         = BannerTwoInformation::findOrFail( $request->id );
        
        return view('system.banner-two-informations.update', [
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
            'school_id'            => 'required',
            'title'                => 'required',
            'subtitle'             => 'required',
            'image_url'            => 'required'
        ]);
        
        $result = BannerTwoInformation::updateItem( $request );

        if ($result) {

            return redirect()->route('bannerTwoInformation-index')->with('success', "Exito!, Información editada correctamente.");

        } else {

            return redirect()->route('bannerTwoInformation-index')->with('error', "Ups!, ha ocurrido un error.");

        }

    }
}
