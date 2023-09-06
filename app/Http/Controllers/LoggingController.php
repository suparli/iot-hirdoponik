<?php

namespace App\Http\Controllers;

use App\Models\Logging;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class LoggingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $device_id = 1;
        $logging = Logging::where("device_id", $device_id)->get();
        //jika ada request ajax maka ambil data untuk datatable
        if (request()->ajax()) {
            return DataTables::of($logging)
            ->addIndexColumn()
            ->make(true);
        }
        return view('pages.logging');
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
     * @param  \App\Models\Logging  $logging
     * @return \Illuminate\Http\Response
     */
    public function show(Logging $logging)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Logging  $logging
     * @return \Illuminate\Http\Response
     */
    public function edit(Logging $logging)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Logging  $logging
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logging $logging)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logging  $logging
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logging $logging)
    {
        //
    }
}
