<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Certification;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    
    public function index( Request $request )
    {

        $module    = 'Publicación';

        $submodule = 'Certificationes';

        $location  = 'Inicio';

        return view('system.certifications.index', [
            'module'    => $module,
            'submodule' => $submodule,
            'location'  => $location
        ]);

    }

    public function create( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Certificationes';

        $location     = 'Crear';

        $list_schools = Certification::getAliveSchools();

        return view('system.certifications.create', [
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
            'name'        => 'required',
            'description' => 'required',
            'image_url'   => 'required'
        ]);
        
        $validateCertificationName = Certification::validateCertificationName( $request->name, null );

        if ( $validateCertificationName ) {

            return redirect()->route('certification-index')->with('error', "Ups!, ya existe una cartificación con el nombre: $request->name.");

        } else {

            $result = Certification::createItem( $request );

            if ($result) {

                return redirect()->route('certification-index')->with('success', "Exito!, cartificación creado correctamente.");

            } else {

                return redirect()->route('certification-index')->with('error', "Ups!, ha ocurrido un error.");

            }

        }

    }

    public function update( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Certificationes';

        $location     = 'Editar';

        $list_schools = Certification::getAliveSchools();

        $item         = Certification::findOrFail( $request->id );
        
        return view('system.certifications.update', [
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
            'school_id'   => 'required',
            'name'        => 'required',
            'description' => 'required',
            'image_url'   => 'required'
        ]);
        
        $validateCertificationName = Certification::validateCertificationName( $request->name, $request->id );

        if ( $validateCertificationName ) {

            return redirect()->route('certification-index')->with('error', "Ups!, ya existe una cartificación con el nombre: $request->name.");

        } else {

            $result = Certification::updateItem( $request );

            if ($result) {

                return redirect()->route('certification-index')->with('success', "Exito!, cartificación editado correctamente.");

            } else {

                return redirect()->route('certification-index')->with('error', "Ups!, ha ocurrido un error.");

            }

        }

    }

}
