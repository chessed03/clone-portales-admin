<?php

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

function __consumeEndPoint( $url_request, $data )
{
    $client = new Client();

    $options = [
        'multipart' => [
            [
                'name' => 'data',
                'contents' => json_encode($data)
            ]/*,
            [
                'name' => 'uuid',
                'contents' => base64_encode($data->uuid)
            ],
            [
                'name' => 'code_school',
                'contents' => base64_encode($data->code_school)
            ],
            [
                'name' => 'code_type',
                'contents' => base64_encode($data->code_type)
            ],
            [
                'name' => 'name',
                'contents' => base64_encode($data->name)
            ],
            [
                'name' => 'description',
                'contents' => base64_encode($data->description)
            ],
            [
                'name' => 'price',
                'contents' => base64_encode($data->price)
            ],
            [
                'name' => 'discount',
                'contents' => base64_encode($data->discount)
            ],
            [
                'name' => 'date',
                'contents' => base64_encode($data->date)
            ]*/
        ]
    ];

    try {

        $request = new Request('POST', 'http://apiserve.dv/api/serve/sisadesel/' . $url_request);
        $response = $client->sendAsync($request, $options)->wait();
        $body = $response->getBody()->__toString();
        return response()->json(['data' => $body], 200);

    } catch (SoapFault $e) {

        return $e;

    }



    /*$api_url  = "http://apiserve.dv/api/serve/sisadesel/" . $url_request;

    $options = [
        'multipart' => [
            [
                'name' => 'key_id',
                'contents' => $data->key_id
            ],
            [
                'name' => 'uuid',
                'contents' => $data->uuid
            ],
            [
                'name' => 'name',
                'contents' => $data->name
            ],
            [
                'name' => 'description',
                'contents' => $data->description
            ],
            [
                'name' => 'price',
                'contents' => $data->price
            ],
            [
                'name' => 'discount',
                'contents' => $data->discount
            ],
            [
                'name' => 'date',
                'contents' => $data->date
            ]
        ]
    ];

    try
    {


        $response = Http::post($api_url, $options)
            ->throw()
            ->json();


        return response()->json([
            'success' => true,
            'data'    => $response
        ], 200);


    }
    catch (SoapFault $e)
    {

        return $e;

    }*/

}
