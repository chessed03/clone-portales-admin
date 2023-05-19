<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Post;
use App\Services\ServiceImagesS3;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index( Request $request )
    {

        $module    = 'Publicación';

        $submodule = 'Publicaciones';

        $location  = 'Inicio';

        return view('system.posts.index', [
            'module'    => $module,
            'submodule' => $submodule,
            'location'  => $location
        ]);

    }

    public function create( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Publicaciones';

        $location     = 'Crear';

        $list_schools = Post::getAliveSchools();

        return view('system.posts.create', [
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

            if ( $status == Post::ALIVE ) {

                $request->validate([
                    'title'             => 'required',
                    'slug'              => 'required',
                    'subtitle'          => 'required',
                    'schools'           => 'required',
                    'meta_keywords'     => 'required',
                    'image_feature_url' => 'required',
                    'content'           => 'required',
                    'status'            => 'required'
                ]);

            }

            if ( $status == Post::PAUSED ) {

                $request->validate([
                    'title'             => 'required',
                    'schools'           => 'required',
                    'status'            => 'required'
                ]);

            }

            $validatePostTitle = Post::validatePostTitle( $request->title, null );

            if ( $validatePostTitle ) {

                return redirect()->route('post-index')->with('error', "Ups!, ya existe un post con el titulo: $request->title.");

            } else {

                $result = Post::createItem( $request );

                if ($result) {

                    return redirect()->route('post-index')->with('success', "Exito!, post creado correctamente.");

                } else {

                    return redirect()->route('post-index')->with('error', "Ups!, ha ocurrido un error.");

                }

            }

        }

        return redirect()->route('post-index')->with('error', "Ups!, ha ocurrido un error.");

    }

    public function update( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Publicaciones';

        $location     = 'Editar';

        $list_schools = Post::getAliveSchools();

        $item         = Post::findOrFail( $request->id );

        return view('system.posts.update', [
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

            if ($status == Post::ALIVE) {

                $request->validate([
                    'title'             => 'required',
                    'slug'              => 'required',
                    'subtitle'          => 'required',
                    'schools'           => 'required',
                    'meta_keywords'     => 'required',
                    'image_feature_url' => 'required',
                    'content'           => 'required',
                    'status'            => 'required'
                ]);

            }

            if ($status == Post::PAUSED) {

                $request->validate([
                    'title'   => 'required',
                    'schools' => 'required',
                    'status'  => 'required'
                ]);

            }

            $validatePostTitle = Post::validatePostTitle($request->title, $request->id);

            if ($validatePostTitle) {

                return redirect()->route('post-index')->with('error', "Ups!, ya existe un post con el titulo: $request->title.");

            } else {

                $result = Post::updateItem($request);

                if ($result) {

                    return redirect()->route('post-index')->with('success', "Exito!, post editado correctamente.");

                } else {

                    return redirect()->route('post-index')->with('error', "Ups!, ha ocurrido un error.");

                }

            }

        }

        return redirect()->route('post-index')->with('error', "Ups!, ha ocurrido un error.");

    }

    public function preview( Request $request )
    {
        $id = $request->id;

        $post = Post::getPostById( $id );

        return  view('system.posts.preview', [
            'post' => $post
        ]);
    }

}
