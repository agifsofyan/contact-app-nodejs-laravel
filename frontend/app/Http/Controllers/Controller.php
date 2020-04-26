<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private static $base_url = 'http://localhost:3000/'; // BASE URL API

    public static function curl_get($url)
    {
    	$curl = curl_init();

        $url = Controller::$base_url.$url;
        
        $headers = array(
            "Accept: application/json"
        );

		curl_setopt_array($curl, array(
		  	CURLOPT_URL 			=> $url,
			CURLOPT_RETURNTRANSFER 	=> true,
			CURLOPT_ENCODING 		=> "",
			CURLOPT_MAXREDIRS 		=> 10,
			CURLOPT_TIMEOUT 		=> 30,
			CURLOPT_HTTP_VERSION 	=> CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST 	=> "GET",
			CURLOPT_HTTPHEADER 		=> $headers,
		));

		$result = curl_exec($curl);

		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			return "cURL Error #:" . $err;
		} else {
			return $result;
		}
    }

    public static function curl_post($url, $fields = array())
    {
        $curl = curl_init();

        $url = Controller::$base_url.$url;

    	$headers = array(
            'Content-Type: application/json'
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL             => $url,
            CURLOPT_RETURNTRANSFER  => true,
            // CURLOPT_ENCODING        => "",
            // CURLOPT_MAXREDIRS       => 10,
            // CURLOPT_TIMEOUT         => 30,
            // CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST   => "POST",
            CURLOPT_HTTPHEADER      => $headers,
            CURLOPT_POSTFIELDS      => json_encode($fields),
            CURLOPT_FOLLOWLOCATION  => true
        ));

        $result = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $result;
        }
    }
}
