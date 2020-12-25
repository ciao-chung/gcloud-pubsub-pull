<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
class Controller extends BaseController
{
    public function receiveNotification(Request $request)
    {
        if(env('APP_ENV') != 'testing') {
            logger($request->all());
            if (isset($request['message']['attributes'])) {
                logger($request['message']['attributes']);
            }

            if (isset($request['message']['data'])) {
                $decodedData = base64_decode($request['message']['data']);
                logger($decodedData);
            }
        }
        return response('Ok', 200);
    }
}
