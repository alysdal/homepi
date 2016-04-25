<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function sensor(Request $request)
    {

        $result = app('db')->insert('INSERT INTO sensorreadings (sensor, temp, humidity, created_at) 
              VALUES (:sensor, :temp, :humidity, CURRENT_TIMESTAMP)',
            [
                'sensor' => $request->name,
                'temp' => $request->temperature,
                'humidity' => $request->humidity,
            ]);


        return $request->input();
    }

    //
}
