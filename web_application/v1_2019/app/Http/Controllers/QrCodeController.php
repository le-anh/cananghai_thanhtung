<?php

namespace App\Http\Controllers;

use App\QrCode;
use Illuminate\Http\Request;
use DB;

class QrCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
     * @param  \App\QrCode  $qrCode
     * @return \Illuminate\Http\Response
     */
    public function show(QrCode $qrCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QrCode  $qrCode
     * @return \Illuminate\Http\Response
     */
    public function edit(QrCode $qrCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QrCode  $qrCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QrCode $qrCode)
    {
        //
    }

    public static function UpdateStatusUsedBySTT($stt)
    {
        $qrCode = QrCode::where('stt', '=', $stt)->first();
        if($qrCode)
        {
            $qrCode->trangthaiqrcodebar_id = 2;
            $qrCode->save();
        }
    }

    public static function UpdateStatusUsedByQR($qr)
    {
        $qrCode = QrCode::where('maqr', '=', $qr)->first();
        if($qrCode)
        {
            $qrCode->trangthaiqrcodebar_id = 2;
            $qrCode->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QrCode  $qrCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(QrCode $qrCode)
    {
        //
    }

    public static function MapQrCodeToNumber($qr = '')
    {
        $qrCode = QrCode::where('maqr', '=', $qr)->first();
        if($qrCode)
            return $qrCode->stt;
        return '';
    }
    
    public static function MapNumberToQRCode($numQr = '')
    {
        $qrCode = QrCode::where('stt', '=', $numQr)->orderBy('id', 'asc')->first();
        if($qrCode)
            return $qrCode->maqr;
        return '';
    }

    

    
}
