<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\CarouselImage;
use Illuminate\Http\Request;

class CarouselImageController extends Controller
{

    public function index( Request $request )
    {

        $module    = 'Publicación';

        $submodule = 'Carrusel de imágenes';

        $location  = 'Inicio';

        return view('system.carousel-images.index', [
            'module'    => $module,
            'submodule' => $submodule,
            'location'  => $location
        ]);

    }

    public function create( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Carrusel de imágenes';

        $location     = 'Crear';
        //$list_sites = CarouselImage::getAliveSites();
        $list_schools = CarouselImage::getAliveSchools();

        return view('system.carousel-images.create', [
            'module'       => $module,
            'submodule'    => $submodule,
            'location'     => $location,
            'list_schools' => $list_schools
        ]);

    }

    public function saveCreate( Request $request )
    {

        $request->validate([
            'schools'         => 'required',
            'name'            => 'required',
            'image_url'       => 'required',
            'image_movil_url' => 'required'
        ]);

        $result = CarouselImage::createItem( $request );

        if ($result) {

            return redirect()->route('carousel-image-index')->with('success', "Exito!, imagen creada correctamente.");

        } else {

            return redirect()->route('carousel-image-index')->with('error', "Ups!, ha ocurrido un error.");

        }

    }

    public function update( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Sitios';

        $location     = 'Editar';
        //$list_sites = CarouselImage::getAliveSites();
        $list_schools = CarouselImage::getAliveSchools();

        $item         = CarouselImage::findOrFail( $request->id );

        return view('system.carousel-images.update', [
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
            'schools'         => 'required',
            'name'            => 'required',
            'image_url'       => 'required',
            'image_movil_url' => 'required'
        ]);

        $result = CarouselImage::updateItem( $request );

        if ($result) {

            return redirect()->route('carousel-image-index')->with('success', "Exito!, imagen editado correctamente.");

        } else {

            return redirect()->route('carousel-image-index')->with('error', "Ups!, ha ocurrido un error.");

        }

    }

}
