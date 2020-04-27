<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as System;
use Carbon\Carbon;
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

        $data = json_decode(System::curl_get($url, "GET"))->data;

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


        $data = json_decode(System::curl_post($url, "POST", $row));

        if ($data->code != 201) {
            Session::flash('flash_message', $data->message);

            return redirect()->back()->withInput($req->all());
        }else{
            Session::flash('flash_message', $data->message);

            return redirect()->route('contact.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $url = "contact/{$id}";

        $data = json_decode(System::curl_get($url, "GET"))->data;

        return view('contacts.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $url = "contact/{$id}";

        $check = json_decode(System::curl_get($url, "GET"))->data;

        $row = array(
            'name'       => empty($req->name)       ? $check->name       : $req->name,
            'number'     => empty($req->number)     ? $check->number     : $req->number,
            'address'    => empty($req->address)    ? $check->address    : $req->address,
            'birthplace' => empty($req->birthplace) ? $check->birthplace : $req->birthplace,
            'birthday'   => empty($req->birthday)   ? $check->birthday   : $req->birthday,
            'info'       => empty($req->info)       ? $check->info       : $req->info
        );


        $data = json_decode(System::curl_post($url, "PUT", $row));

        if ($data->code != 201) {
            Session::flash('flash_message', $data->message);

            return redirect()->back()->withInput($req->all());
        }else{
            Session::flash('flash_message', $data->message);

            return redirect()->route('contact.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $url = "contact/{$id}";

        $data = json_decode(System::curl_get($url, "DELETE"));

        if ($data->code != 200) {
            Session::flash('flash_message', $data->message);

            return redirect()->back();
        }else{
            Session::flash('flash_message', $data->message);

            return redirect()->route('contact.index');
        }
    }

    public function drop(Request $req)
    {
        $url = "contacts";

        $rows = $req->id;

        $field = array();
        foreach ($rows as $row) {
            $field[] = (int) $row;
        }

        $data = json_decode(System::curl_post($url, "DELETE", $field));

        Session::flash('flash_message', $data->message);

        return response()->json(['status' => $data->message]);
    }
}
