<?php

namespace App\Http\Controllers;

use App\Retailer;
use Illuminate\Http\Request;
use App\Http\Requests\RetailerRequest;

class RetailerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $retailerList = self::RetailerList();
        return view('retailer_list', ['retailerList'=>$retailerList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('retailer_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RetailerRequest $request)
    {
        try {
            $tradeId = self::GenerateRetailerID();

            $objData = (object) [
                "\$class" => "agu.fit.lhanh.Retailer",
                "tradeId" => '700807569', // $tradeId,
                "companyName" => $request->companyname,
                "address" => [
                    "\$class" => "agu.fit.lhanh.Address",
                    "country" => "Việt Nam",
                    "province" => $request->province,
                    "district" => $request->city,
                    "town" => $request->town,
                    "street"=> "",
                    "apartmentnum" => $request->apartmentnum
                ]
            ];

            $response= ClientAPIController::Retailer("POST", '', $objData);

            return redirect()->route('retailer_create')->with('success', "Lưu thành công");
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Retailer  $retailer
     * @return \Illuminate\Http\Response
     */
    public function show(Retailer $retailer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Retailer  $retailer
     * @return \Illuminate\Http\Response
     */
    public function edit(Retailer $retailer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Retailer  $retailer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Retailer $retailer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Retailer  $retailer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Retailer $retailer)
    {
        //
    }

    public static function RetailerList()
    {
        $response = ClientAPIController::Retailer();
        if($response)
            if($response->getStatusCode() == 200)
                return json_decode($response->getBody());
        return null;
    }

    public function GenerateRetailerID()
    {
        while (1) {
            $generateRetailerID = env('PRE_Retailer_ID') . ServiceController::RandomNum(env('LEN_SUF_COMPANY_ID'));

            $response = ClientAPIController::Retailer("GET", $generateRetailerID, '');

            if($response)
                if($response->getStatusCode() != 200)
                    break;
        }
        
        return $generateRetailerID;
    }
}
