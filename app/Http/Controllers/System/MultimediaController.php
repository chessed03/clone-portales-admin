<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Multimedia;
use App\Services\ServiceImagesS3;
use Illuminate\Http\Request;

class MultimediaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function uploadImage( Request $request )
    {
    
        /*$modelo = new Multimedia();
        $archivo = $request->file('file');
        $modelo->addMedia($archivo)->toMediaCollection('imagenes');
        $image = $modelo->addMediaConversion('imagenes')
              ->width(368)
              ->height(232)
              ->sharpen(10);
              $path = $image->getPath('imagenes', $modelo);*/
        
        $img = ServiceImagesS3::upload( $request, "file" );

        return response()->json( ['location' => $img->url] );

    }

}
