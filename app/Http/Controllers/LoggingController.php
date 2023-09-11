<?php

namespace App\Http\Controllers;

use App\Models\Logging;
use App\Models\Device;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class LoggingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $device = Device::all();
        
        //jika ada request ajax maka ambil data untuk datatable
        if (request()->ajax()) {
            $device_id = $request->input('deviceId');
            $logging = Logging::where("device_id", $device_id)->orderBy('id', "DESC")->get();
            return DataTables::of($logging)
            ->addIndexColumn()
            ->make(true);
        }
        return view('pages.logging',['devices' => $device]);
    }

    public function device(Request $request)
    {
        $deviceId = $request->input('deviceId');
       $deviceTime = $request->input('deviceTime');
       $interval = $request->input('interval');
       $pompaPh = $request->input('pompaPh');
       $pompaEc = $request->input('pompaEc');
       $waterLevel = $request->input('waterLevel');
       $ph = $request->input('ph');
       $ec = $request->input('ec');
       $tds = $request->input('tds');
       $temperature = $request->input('temperature');
       $humidity = $request->input('humidity');
       $waterTemp = $request->input('waterTemp');

       Logging::create([
            'device_id' => $deviceId,
            'device_time' => $deviceTime,
            'water_level' => $waterLevel,
            'pompa_ph' => ($pompaPh == 1) ? true : false,
            'pompa_ec' => ($pompaEc == 1) ? true : false,
            'temperature' => $temperature,
            'humidity' => $humidity,
            'ph' => $ph,
            'ec' => $ec,
            'tds' => $tds,
            'water_temp' => $waterTemp
       ]);


       return response()->json(['message' => 'success'], 200);
    }

    
}
