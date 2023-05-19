<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Services\ServiceImagesS3;

class ProgramController extends Controller
{

    public function index( Request $request )
    {

        $module    = 'Publicación';

        $submodule = 'Programas';

        $location  = 'Inicio';

        return view('system.programs.index', [
            'module'    => $module,
            'submodule' => $submodule,
            'location'  => $location
        ]);

    }

    public function create( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Programas';

        $location     = 'Crear';

        $list_schools = Program::getAliveSchools();

        return view('system.programs.create', [
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

            if ($status == Program::ALIVE) {

                $request->validate([
                    'school_id' => 'required',
                    'name' => 'required',
                    'slug' => 'required',
                    'level' => 'required',
                    'area' => 'required',
                    'description' => 'required',
                    'duration' => 'required',
                    'image_url' => 'required',
                    'content' => 'required',
                    'meta_keywords' => 'required',
                    'file' => 'max:20000',
                    'status' => 'required'
                ]);

            }

            if ($status == Program::PAUSED) {

                $request->validate([
                    'school_id' => 'required',
                    'name' => 'required',
                    'file' => 'max:20000',
                    'status' => 'required'
                ]);

            }

            $validateProgramName = Program::validateProgramName($request->name, null);

            if ($validateProgramName) {

                return redirect()->route('program-index')->with('error', "Ups!, ya existe un programa con el nombre: $request->name.");

            } else {


                if ($request->file('file')) {

                    $object = ServiceImagesS3::upload($request, 'file');

                    $request->request->add([
                        "pdf" => $object->url
                    ]);

                }


                $result = Program::createItem($request);

                if ($result) {

                    return redirect()->route('program-index')->with('success', "Exito!, programa creado correctamente.");

                } else {

                    return redirect()->route('program-index')->with('error', "Ups!, ha ocurrido un error.");

                }

            }

        }

        return redirect()->route('program-index')->with('error', "Ups!, ha ocurrido un error.");

    }

    public function update( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Programas';

        $location     = 'Editar';

        $list_schools = Program::getAliveSchools();

        $item         = Program::findOrFail( $request->id );

        return view('system.programs.update', [
            'module'       => $module,
            'submodule'    => $submodule,
            'location'     => $location,
            'list_schools' => $list_schools,
            'item'         => $item
        ]);

    }

    public function saveUpdate( Request $request )
    {

        $status = $request->status;

        if ( $status ) {

            if ( $status == Program::ALIVE ) {

                $request->validate([
                    'school_id'        => 'required',
                    'name'             => 'required',
                    'slug'             => 'required',
                    'level'            => 'required',
                    'area'             => 'required',
                    'description'      => 'required',
                    'duration'         => 'required',
                    'image_url'        => 'required',
                    'content'          => 'required',
                    'meta_keywords'    => 'required',
                    'file'             => 'max:20000',
                    'status'           => 'required'
                ]);

            }

            if ($status == Program::PAUSED) {

                $request->validate([
                    'school_id' => 'required',
                    'name'      => 'required',
                    'file'      => 'max:20000',
                    'status'    => 'required'
                ]);

            }

            $validateProgramName = Program::validateProgramName( $request->name, $request->id );

            if ( $validateProgramName ) {

                return redirect()->route('program-index')->with('error', "Ups!, ya existe un programa con el nombre: $request->name.");

            } else {


                if ( $request->file('file') ) {

                    $object = ServiceImagesS3::upload($request,'file');

                    $request->request->add([
                        "pdf" => $object->url
                    ]);

                }


                $result = Program::updateItem( $request );

                if ($result) {

                    return redirect()->route('program-index')->with('success', "Exito!, programa editado correctamente.");

                } else {

                    return redirect()->route('program-index')->with('error', "Ups!, ha ocurrido un error.");

                }

            }

        }

        return redirect()->route('program-index')->with('error', "Ups!, ha ocurrido un error.");

    }

}
