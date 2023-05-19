<?php

namespace App\Services;

class ServiceImagesS3
{

    public static function upload( $request, $image_name = 'image', $hide = false)
    {

        if ( !$request->hasFile($image_name) ) {

            return true;
        }

        $base              = "https://ipes2.s3.us-east-2.amazonaws.com";

        $client_name       = ($request->file($image_name)->getClientOriginalName()) ?? "image";

        $client_name       = str_replace(" ","-",$client_name);

        list($client_name) = explode(".",$client_name);

        $image             = $request->file($image_name);

        $s3                = \Storage::disk('s3');

        $file_name         = uniqid() .'-'.$client_name.'.'. $image->getClientOriginalExtension();

        $s3filePath        = '/' . $file_name;

        $image_object      = null;

        try {

            $s3->put($s3filePath, file_get_contents($image), 'public');

            $url               = $base.$s3filePath;

            $image_object      = new \stdClass();

            $image_object->url = $url;

        }
        catch (\Exception $exception){

            $image_object      = new \stdClass();

            $image_object->url = 'error';
        }

        return  $image_object;

    }

}
