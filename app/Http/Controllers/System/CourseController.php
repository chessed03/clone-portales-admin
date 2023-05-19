<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    
    public function index( Request $request )
    {

        $module    = 'Publicación';

        $submodule = 'Cursos';

        $location  = 'Inicio';

        return view('system.courses.index', [
            'module'    => $module,
            'submodule' => $submodule,
            'location'  => $location
        ]);

    }

    public function create( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Cursos';

        $location     = 'Crear';

        $list_schools = Course::getAliveSchools();

        return view('system.courses.create', [
            'module'       => $module,
            'submodule'    => $submodule,
            'location'     => $location,
            'list_schools' => $list_schools
        ]);

    }

    public function saveCreate( Request $request )
    {

        $request->validate([
            'name'        => 'required',
            'description' => 'required',
            'start_date'  => 'required',
            'finish_date' => 'required',
            'location'    => 'required',
            'image_url'   => 'required'
        ]);
        
        $validateCourseName = Course::validateCourseName( $request->name, null );

        if ( $validateCourseName ) {

            return redirect()->route('course-index')->with('error', "Ups!, ya existe un curso con el nombre: $request->name.");

        } else {

            $result = Course::createItem( $request );

            if ($result) {

                return redirect()->route('course-index')->with('success', "Exito!, curso creado correctamente.");

            } else {

                return redirect()->route('course-index')->with('error', "Ups!, ha ocurrido un error.");

            }

        }

    }

    public function update( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Cursos';

        $location     = 'Editar';

        $list_schools = Course::getAliveSchools();

        $item         = Course::findOrFail( $request->id );

        $notice       = Course::findNoticeById( $request->id );
        
        return view('system.courses.update', [
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
        
        $request->validate([
            'name'        => 'required',
            'description' => 'required',
            'start_date'  => 'required',
            'finish_date' => 'required',
            'location'    => 'required',
            'image_url'   => 'required'
        ]);
        
        $validateCourseName = Course::validateCourseName( $request->name, $request->id );

        if ( $validateCourseName ) {

            return redirect()->route('course-index')->with('error', "Ups!, ya existe un curso con el nombre: $request->name.");

        } else {

            $result = Course::updateItem( $request );

            if ($result) {

                return redirect()->route('course-index')->with('success', "Exito!, curso editado correctamente.");

            } else {

                return redirect()->route('course-index')->with('error', "Ups!, ha ocurrido un error.");

            }

        }

    }

}
