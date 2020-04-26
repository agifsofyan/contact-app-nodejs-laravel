<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as System;
use Session;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = 'contacts';

        $data = json_decode(System::curl_get($url))->data;

        return view('contacts.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(System $system, Request $req)
    {
        $url = 'contacts';

        $row = array(
            'name'       => $req->name,
            'number'     => $req->number,
            'address'    => $req->address,
            'birthplace' => $req->birthplace,
            'birthday'   => $req->birthday,
            'info'       => $req->info
        );


        $data = json_decode(System::curl_post($url, $row));

        if ($data->code != 201) {
            Session::flash('flash_message', $data->message);

            return redirect()->back()->withInput($req->all());
        }else{
            Session::flash('flash_message', $data->message);

            return redirect()->route('contact.index');
        }

        // return view('contacts.index', compact('data'));
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
