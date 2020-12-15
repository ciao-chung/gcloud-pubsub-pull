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
            logger($request['message']['attributes']);
        }
        return response('Ok', 200);
    }
}
