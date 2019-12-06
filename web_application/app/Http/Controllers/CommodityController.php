<?php

namespace App\Http\Controllers;

use App\Commodity;
use Illuminate\Http\Request;

class CommodityController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $commodityCategoryList = CommodityCategoryController::CommodityCategory();
        return view('commodity_create', ['commodityCategoryList'=>$commodityCategoryList]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function store(Request $request)
    {
        if($request->tuychon == 2)
            $result = self::StoreWithNumQR($request);
        else
            $result = self::StoreWithQR($request);
        if($result->boolresult)
            return redirect()->route('commodity_create')->with('success', "Lưu thành công!");
        else
            return redirect()->back()->withInput()->with('danger', "Lưu không thành công!<br>" . $result->messages);
    }

    public static function StoreWithNumQR($request)
    {
        if($request->date)
            $date = $request->date;
        else
            $date = now();
        $dateProduct = date('Y-m-d', strtotime($date))."T".date("H:i:s", strtotime($date)).".108Z";
        return self::StoreWithNumQRStartAndEnd($request->cate, $dateProduct, $request->numqrstart, $request->numqrend);
    }

    public static function StoreWithQR($request)
    {
        if($request->date)
            $date = $request->date;
        else
            $date = now();
        $dateProduct = date('Y-m-d', strtotime($date))."T".date("H:i:s", strtotime($date)).".108Z";

        $numQRStart = QrCodeController::MapQRCodeToNumber($request->qrstart);
        $numQREnd = QrCodeController::MapQRCodeToNumber($request->qrstart);
        return self::StoreWithNumQRStartAndEnd($request->cate, $dateProduct, $numQRStart, $numQREnd);
    }

    public static function StoreWithNumQRStartAndEnd($cateId = '', $date = '', $numQrStart = '', $numQrEnd = '')
    {
        $boolValidate = true;
        $messages = "";
        $result = self::ValidateQRStartAndEnd($numQrStart, $numQrEnd);
        if($result->boolresult)
        {
            if(empty($numQrEnd))
                $numQrEnd = $numQrStart;

            $commodityCate = CommodityCategoryController::CommodityCategoryByID($cateId);
            for ($i = $numQrStart; $i <= $numQrEnd; $i++) { 
                $qr = QrCodeController::MapNumberToQRCode($i);
                $data = (object) [
                    "\$class" => "agu.fit.lhanh.Commodity",
                    "tradingSymbol" => $qr,
                    "name" => $commodityCate->ten,
                    "description" => $commodityCate->thanhphan,
                    "dateProduct" => $date, // "2019-08-09T06:06:34.080Z",
                    "quantity" => 1,
                    "unitPrice" => 0,
                    "totalPrice" => 0,
                    "owner" => "resource:agu.fit.lhanh.Manufacturer#300318246",
                    "issuer" => "resource:agu.fit.lhanh.Manufacturer#300318246"
                ];
                $response = ClientAPIController::Commodity('POST', '', $data);
                QrCodeController::UpdateStatusUsedBySTT($i);
            }
            return (object) array('boolresult'=>$boolValidate, 'messages'=>"Tạo thành công!");
        }
        else
            return $result;
    }

    public static function ValidateQRStartAndEnd($numQrStart = '', $numQrEnd = '')
    {
        $boolValidate = true;
        $messages = "";
        if(empty($numQrEnd))
            $numQrEnd = $numQrStart;

        if($numQrEnd >= $numQrStart)
        {
            for ($i = $numQrStart; $i <= $numQrEnd; $i++) { 
                if(self::isExistCommodityWithNumQR($i))
                {
                    $boolValidate = false;
                    $messages .= $i . ", ";
                }
            }
            if(!$boolValidate)
            $messages = "Những tem " . $messages . " đã được sử dụng";
        }
        else
        {
            $boolValidate = false;
            $messages = " Tem đầu và cuối không hợp lệ.";
        }

        return (object) array('boolresult'=>$boolValidate, 'messages'=>$messages);
    }

    public static function isExistCommodityWithNumQR($numQR = '')
    {
        $qr = QrCodeController::MapNumberToQRCode($numQR);
        $response = ClientAPIController::Commodity('GET', $qr,'');
        if($response)
            if($response->getStatusCode() == 200)
                if($response->getBody())
                    return true;
        
        return false;
    }
    


    /**
     * Display the specified resource.
     *
     * @param  \App\Commodity  $commodity
     * @return \Illuminate\Http\Response
     */
    public function show(Commodity $commodity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Commodity  $commodity
     * @return \Illuminate\Http\Response
     */
    public function edit(Commodity $commodity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Commodity  $commodity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commodity $commodity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Commodity  $commodity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commodity $commodity)
    {
        //
    }
}
