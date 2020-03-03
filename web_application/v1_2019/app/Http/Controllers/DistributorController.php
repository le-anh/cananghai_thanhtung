<?php

namespace App\Http\Controllers;

use App\Distributor;
use Illuminate\Http\Request;
use App\Http\Requests\DistributorRequest;

class DistributorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distributorList = self::DistributorList();
        return view('distributor_list', ['distributorList'=>$distributorList]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('distributor_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DistributorRequest $request)
    {
        try {
            $tradeId = self::GenerateDistributorID();

            $objData = (object) [
                "\$class" => "agu.fit.lhanh.Distributor",
                "tradeId" => $tradeId,
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

            $response= ClientAPIController::Distributor("POST", '', $objData);

            return redirect()->route('distributor_create')->with('success', "Lưu thành công");
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function show(Distributor $distributor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function edit(Distributor $distributor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Distributor $distributor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Distributor $distributor)
    {
        //
    }

    public static function DistributorList()
    {
        $response = ClientAPIController::Distributor();
        if($response)
            if($response->getStatusCode() == 200)
                return json_decode($response->getBody());
        return null;
    }

    public function GenerateDistributorID()
    {
        while (1) {
            $generateDistributorID = env('PRE_DISTRIBUTOR_ID') . ServiceController::RandomNum(env('LEN_SUF_COMPANY_ID'));

            $response = ClientAPIController::Distributor("GET", $generateDistributorID, '');

            if($response)
                if($response->getStatusCode() != 200)
                    break;
        }
        
        return $generateDistributorID;
    }
}
