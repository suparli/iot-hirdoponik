<?php

namespace App\Http\Controllers;

use App\Models\Kontrol;
use App\Models\Device;
use Illuminate\Http\Request;

class KontrolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $device = Device::all();
        $device_id = $request->input('deviceId');
        $kontrol = Kontrol::find($device_id);
        //jika ada request ajax maka ambil data untuk datatable
        if (request()->ajax()) {
            $data = $kontrol->toJson();
            return $data;
        }
        return view('pages.kontrol',['devices' => $device]);
    }

    public function update(Request $request, Kontrol $kontrol)
    {   
        $deviceId = $request->deviceId;
        Kontrol::where('device_id', $deviceId)->update([
            'pompa_ph' => ($request->pompaPh == 'on' ) ?  1 : 0,
            'pompa_ec' => ($request->pompaEc == 'on' ) ?  1 : 0,
            'mode'     => ($request->mode == 'on' ) ?  1 : 0,
            'interval' => $request->interval,
            'ba_ph'    => $request->baPh,
            'bb_ph'    => $request->bbPh,
            'ba_ec'    => $request->baEc,
            'bb_ec'    => $request->bbEc,
        ]);

        return 'success';
    }

    public function device(Request $request)
    {
        $deviceId = $request->input('deviceId');
        $deviceTime = $request->input('deviceTime');
        $kontrol = Kontrol::where('device_id', $deviceId)->first();
        $kontrol->update(['device_time' => $deviceTime]);
        return response()->json( ['message' => 'success', 'data' =>$kontrol], 200);
    }
}
