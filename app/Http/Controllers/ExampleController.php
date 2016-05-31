<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aws\DynamoDb\Marshaler;

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
        $table = "LysdalIOTSensorReadings";


        $client = \App::make('aws')->createClient('DynamoDB');
        $marshaler = new Marshaler();

        $reading = new \stdClass();
        $reading->SensorName = $request->input('name');
        $reading->Temperature = $request->input('temperature');
        $reading->Humidity = $request->input('humidity');
        $reading->SensorType = $request->input('type') == "" ? "DHT11" : $request->input('type');
        $reading->CreatedAt = \Carbon\Carbon::now()->toIso8601String();


        $client->putItem([
            'TableName' => $table,
            'Item' => $marshaler->marshalItem($reading)
        ]);

        return json_encode($reading);
    }

    //
}
