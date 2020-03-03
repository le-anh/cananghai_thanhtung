<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception;

class ClientAPIController extends Controller
{
    const X_API_KEY = "HDuZieF8xixZNbBhIfPyiwlIlM7BUNeZ";

    public static function Test()
    {
        // dd(env('ADDRESS_API').'Commodity');
        // $client = new \GuzzleHttp\Client(['verify' => '../config/cacert.pem']);
        // $client = new Client();
        // $client = new Client(['http_errors' => false]);
        $response = self::Commodity();// $client->request('GET', env('ADDRESS_API').'Commodity');
        dd($response);
        // return view('chain_supply', ['response'=>$response]);

        // echo $response->getStatusCode();
        // echo $response->getHeaderLine('content-type');
        // echo $response->getBody();

        // $request = new \GuzzleHttp\Psr7\Request('GET', 'http://171.244.37.43:3002/api/ap/Commodity');
        // $promise = $client->sendAsync($request)->then(function ($response) {
        //     echo 'I completed! ' . $response->getStatusCode();
        // });

        // $promise->wait();

    }

    public static function trace($code = '')
    {
        if(empty($code) || $code === '')
            return view('trace', ['noneCode'=>1]);
        else
        {
            $response = self::Commodity("GET", $code, "");
            return view('trace', ['response'=>$response]);
        }
    }

    public static function transaction($transactionId = '')
    {
        $response = self::TransferCommodity("GET", $transactionId, "");
        if($response)
            return array('statusCode'=> $response->getStatusCode(), 'body' => json_decode($response->getBody()));
        return array('statusCode'=> 500, 'body' => "");
    }

    public static function InitialClient()
    {
        return new Client(['http_errors' => false, 'headers'=>['x-api-key' => self::X_API_KEY]]);
    }


    public static function Commodity($method="GET", $suffix="", $data="")
    {
        try {
            $url = env('ADDRESS_API') . 'Commodity/' . $suffix;
            $client = self::InitialClient();
            if($data=="" || $data==null)
                $response = $client->request($method, $url);
            else
                $response = $client->request($method, $url, ['json'=>$data]);
            return $response;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return $e->getResponse();
        }
    }

    public static function Manufacturer($method="GET", $suffix="", $data="")
    {
        try {
            $url = env('ADDRESS_API') . 'Manufacturer/' . $suffix;
            $client = self::InitialClient();
            if($data=="" || $data==null)
                $response = $client->request($method, $url);
            else
                $response = $client->request($method, $url, ['json'=>$data]);
            return $response;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return $e->getResponse();
        }
    }

    public static function Distributor($method="GET", $suffix="", $data="")
    {
        try {
            $url = env('ADDRESS_API') . 'Distributor/' . $suffix;
            $client = self::InitialClient();
            if($data=="" || $data==null)
                $response = $client->request($method, $url);
            else
                $response = $client->request($method, $url, ['json'=>$data]);
            return $response;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return $e->getResponse();
        }
    }

    public static function Retailer($method="GET", $suffix="", $data="")
    {
        try {
            $url = env('ADDRESS_API') . 'Retailer/' . $suffix;
            $client = self::InitialClient();
            if($data=="" || $data==null)
                $response = $client->request($method, $url);
            else
                if($data=="" || $data==null)
                $response = $client->request($method, $url);
            else
                $response = $client->request($method, $url, ['json'=>$data]);
            return $response;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return $e->getResponse();
        }
    }

    public static function Customer($method="GET", $suffix="", $data="")
    {
        try {
            $url = env('ADDRESS_API') . 'Customer/' . $suffix;
            $client = self::InitialClient();
            if($data=="" || $data==null)
                $response = $client->request($method, $url);
            else
                $response = $client->request($method, $url, ['json'=>$data]);
            return $response;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return $e->getResponse();
        }
    }
    
    public static function TransferCommodity($method="GET", $suffix="", $data="")
    {
        try {
            $url = env('ADDRESS_API') . 'TransferCommodity/' . $suffix;
            $client = self::InitialClient();
            if($data=="" || $data==null)
                $response = $client->request($method, $url);
            else
                $response = $client->request($method, $url, ['json'=>$data]);
            return $response;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return $e->getResponse();
        }
    }
}
