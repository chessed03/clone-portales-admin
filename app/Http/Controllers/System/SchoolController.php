<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\School;
use App\Services\ServiceImagesS3;
use Illuminate\Http\Request;

class SchoolController extends Controller
{

    public function index( Request $request )
    {

        $module    = 'Configuración';

        $submodule = 'Universidades';

        $location  = 'Inicio';

        return view('system.schools.index', [
            'module'    => $module,
            'submodule' => $submodule,
            'location'  => $location
        ]);

    }

    public function create( Request $request )
    {

        $module    = 'Configuración';

        $submodule = 'Universidades';

        $location  = 'Crear';

        return view('system.schools.create', [
            'module'       => $module,
            'submodule'    => $submodule,
            'location'     => $location
        ]);

    }

    public function saveCreate( Request $request )
    {

        $request->validate([
            'name'                      => 'required',
            'contact'                   => 'required',
            'address'                   => 'required',
            'phone_main'                => 'required',
            'email_main'                => 'required',
            'description'               => 'required',
            'logo_url'                  => 'required',
            'title_about_us'            => 'required',
            'mission_about_us'          => 'required',
            'vision_about_us'           => 'required',
            'description_about_us'      => 'required',
            'background_color_about_us' => 'required',
            'meta_keywords'             => 'required',
            'meta_description'          => 'required',
            'notice_privacy'            => 'required'
        ]);

        $validateSchoolName = School::validateSchoolName( $request->title, null );

        if ( $validateSchoolName ) {

            return redirect()->route('school-index')->with('error', "Ups!, ya existe una universidad con el titulo: $request->title.");

        } else {

            $result = School::createItem( $request );

            if ($result) {

                return redirect()->route('school-index')->with('success', "Exito!, universidad creada correctamente.");

            } else {

                return redirect()->route('school-index')->with('error', "Ups!, ha ocurrido un error.");

            }

        }

    }

    public function update( Request $request )
    {

        $module    = 'Configuración';

        $submodule = 'Universidades';

        $location  = 'Editar';

        $item      = School::findOrFail( $request->id );

        return view('system.schools.update', [
            'module'       => $module,
            'submodule'    => $submodule,
            'location'     => $location,
            'item'         => $item
        ]);

    }

    public function saveUpdate( Request $request )
    {

        $request->validate([
            'name'                      => 'required',
            'contact'                   => 'required',
            'address'                   => 'required',
            'phone_main'                => 'required',
            'email_main'                => 'required',
            'description'               => 'required',
            'logo_url'                  => 'required',
            'title_about_us'            => 'required',
            'mission_about_us'          => 'required',
            'vision_about_us'           => 'required',
            'description_about_us'      => 'required',
            'background_color_about_us' => 'required',
            'meta_keywords'             => 'required',
            'meta_description'          => 'required',
            'notice_privacy'            => 'required'
        ]);

        $validateSchoolName = School::validateSchoolName( $request->title, $request->id );

        if ( $validateSchoolName ) {

            return redirect()->route('school-index')->with('error', "Ups!, ya existe una universidad con el titulo: $request->title.");

        } else {



            if($request->file()) {
                //dd($request);
                $object = ServiceImagesS3::upload($request,'file');
               // dd($object);
                $request->request->add(["footer_image_url"=>$object->url]);

            }


            $result = School::updateItem( $request );

            if ($result) {

                return redirect()->route('school-index')->with('success', "Exito!, universidad editada correctamente.");

            } else {

                return redirect()->route('school-index')->with('error', "Ups!, ha ocurrido un error.");

            }

        }

    }
}
