<?php

namespace App\Http\Controllers;

use App\Models\Kontrol;
use Illuminate\Http\Request;

class KontrolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $device_id = 1;
        $kontrol = Kontrol::find($device_id);
        //jika ada request ajax maka ambil data untuk datatable
        if (request()->ajax()) {
            $data = $kontrol->toJson();
            return $data;
        }
        return view('pages.kontrol');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kontrol  $kontrol
     * @return \Illuminate\Http\Response
     */
    public function show(Kontrol $kontrol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kontrol  $kontrol
     * @return \Illuminate\Http\Response
     */
    public function edit(Kontrol $kontrol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kontrol  $kontrol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kontrol $kontrol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kontrol  $kontrol
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kontrol $kontrol)
    {
        //
    }
}
