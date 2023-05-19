<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\BannerOneInformation;
use Illuminate\Http\Request;

class BannerOneInformationController extends Controller
{
    public function index( Request $request )
    {

        $module    = 'Publicación';

        $submodule = 'Cinta Informativa 1';

        $location  = 'Inicio';

        return view('system.banner-one-informations.index', [
            'module'    => $module,
            'submodule' => $submodule,
            'location'  => $location
        ]);

    }

    public function create( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Cinta Informativa 1';

        $location     = 'Crear';

        $list_schools = BannerOneInformation::getAliveSchools();

        return view('system.banner-one-informations.create', [
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
            'title_quality_one'    => 'required',
            'subtitle_quality_one' => 'required',
            'icon_quality_one'     => 'required',
            'image_url'            => 'required'
        ]);
        
        $result = BannerOneInformation::createItem( $request );

        if ( $result ) {

            return redirect()->route('bannerOneInformation-index')->with('success', "Exito!, Información creada correctamente.");

        } else {

            return redirect()->route('bannerOneInformation-index')->with('error', "Ups!, ha ocurrido un error.");

        }

    }

    public function update( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Cinta Informativa 1';

        $location     = 'Editar';

        $list_schools = BannerOneInformation::getAliveSchools();

        $item         = BannerOneInformation::findOrFail( $request->id );
        
        return view('system.banner-one-informations.update', [
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
            'title_quality_one'    => 'required',
            'subtitle_quality_one' => 'required',
            'icon_quality_one'     => 'required',
            'image_url'            => 'required'
        ]);
        
        $result = BannerOneInformation::updateItem( $request );

        if ($result) {

            return redirect()->route('bannerOneInformation-index')->with('success', "Exito!, Información editada correctamente.");

        } else {

            return redirect()->route('bannerOneInformation-index')->with('error', "Ups!, ha ocurrido un error.");

        }

    }
}
