<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\FaqQuestion;
use Illuminate\Http\Request;

class FaqQuestionController extends Controller
{
    
    public function index( Request $request )
    {

        $module    = 'Publicación';

        $submodule = 'Preguntas';

        $location  = 'Inicio';

        return view('system.faq-questions.index', [
            'module'    => $module,
            'submodule' => $submodule,
            'location'  => $location
        ]);

    }

    public function create( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Preguntas';

        $location     = 'Crear';

        $list_schools = FaqQuestion::getAliveSchools();

        return view('system.faq-questions.create', [
            'module'       => $module,
            'submodule'    => $submodule,
            'location'     => $location,
            'list_schools' => $list_schools
        ]);

    }

    public function saveCreate( Request $request )
    {

        $request->validate([
            'school_id' => 'required',
            'question'  => 'required',
            'answer'    => 'required'
        ]);
        
        $result = FaqQuestion::createItem( $request );

        if ($result) {

            return redirect()->route('faq-question-index')->with('success', "Exito!, pregunta creada correctamente.");

        } else {

            return redirect()->route('faq-question-index')->with('error', "Ups!, ha ocurrido un error.");

        }

    }

    public function update( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Preguntas';

        $location     = 'Editar';

        $list_schools = FaqQuestion::getAliveSchools();

        $item         = FaqQuestion::findOrFail( $request->id );

        return view('system.faq-questions.update', [
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
            'school_id' => 'required',
            'question'  => 'required',
            'answer'    => 'required'
        ]);

       
        $result = FaqQuestion::updateItem( $request );

        if ($result) {

            return redirect()->route('faq-question-index')->with('success', "Exito!, pregunta editada correctamente.");

        } else {

            return redirect()->route('faq-question-index')->with('error', "Ups!, ha ocurrido un error.");

        }

    }


}
