<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Http\Requests\StoreSettings;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSettings  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSettings $request)
    {
        $setting = Setting::updateOrCreate(
            [
                'key' => 'url',
            ],
            [
                'value' => $request->input('url'),
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
