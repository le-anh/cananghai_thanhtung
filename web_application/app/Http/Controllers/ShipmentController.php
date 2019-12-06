<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shipment;
use App\ShipmentDetail;

class ShipmentController extends Controller
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
        $distributorList = DistributorController::DistributorList();
        $retailerList = RetailerController::RetailerList();
        return view('shipment_create', ['distributorList'=>$distributorList, 'retailerList'=>$retailerList]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        print_r($request->toArray());
        
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
        return self::StoreWithNumQRStartAndEnd($request->distributor, $request->retailer, $request->numqrstart, $request->numqrend);
    }

    public static function StoreWithQR($request)
    {
        $numQRStart = QrCodeController::MapQRCodeToNumber($request->qrstart);
        $numQREnd = QrCodeController::MapQRCodeToNumber($request->qrstart);
        return self::StoreWithNumQRStartAndEnd($request->distributor, $request->retailer, $numQRStart, $numQREnd);
    }

    public static function StoreWithNumQRStartAndEnd($distributorId = '', $retailerId = '', $numQrStart = '', $numQrEnd = '')
    {
        $boolValidate = true;
        $messages = "";

        $result = self::ValidateQRStartAndEnd($numQrStart, $numQrEnd);

        if($result->boolresult)
        {
            if(empty($numQrEnd))
                $numQrEnd = $numQrStart;

            $shipment = new Shipment();
            $shipment->sourceparticipanttype = "Distributor";
            $shipment->sourceparticipantid = $distributorId;
            $shipment->destinationparticipantid = $retailerId;
            $shipment->destinationparticipanttype = "Retailer";
            $shipment->commodityparcelstatus_id = 2;
            $shipment->save();

            $issuer = "resource:agu.fit.lhanh.Manufacturer#300318246";
            $newOwner = "resource:agu.fit.lhanh.Distributor#" . $shipment->sourceparticipantid;

            for ($i = $numQrStart; $i <= $numQrEnd; $i++) { 
                $qr = QrCodeController::MapNumberToQRCode($i);
                $shipdDtail = new ShipmentDetail();
                $shipdDtail->commodityparcel_id = $shipment->id;
                $shipdDtail->tradingsymbol = $qr;
                $shipdDtail->commodityparcelstatus_id = 2;
                $shipdDtail->save();

                $objData = (object) [
                    "\$class" => "agu.fit.lhanh.TransferCommodity",
                    "commodity" => "resource:agu.fit.lhanh.Commodity#" . $qr,
                    "issuer" => $issuer,
                    "newOwner" => $newOwner
                ];

                ClientAPIController::TransferCommodity("POST", '', $objData);
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
                if(!CommodityController::isExistCommodityWithNumQR($i))
                {
                    $boolValidate = false;
                    $messages .= $i . ", ";
                }
            }
            if(!$boolValidate)
            $messages = "Những tem " . $messages . " chưa có trên hệ thống blockchain";
        }
        else
        {
            $boolValidate = false;
            $messages = " Tem đầu và cuối không hợp lệ.";
        }

        return (object) array('boolresult'=>$boolValidate, 'messages'=>$messages);
    }

    public function delivered(Request $request)
    {
        $shipment =  Shipment::find($request->id);
        if($shipment)
        {
            $issuer = "resource:agu.fit.lhanh.Distributor#" . $shipment->sourceparticipantid;
            $newOwner = "resource:agu.fit.lhanh.Retailer#" . $shipment->destinationparticipantid;

            $shipDetail = $shipment->shipmentdetail;
            if($shipDetail)
            {
                foreach ($shipDetail as $key => $detail) {
                    $objData = (object) [
                        "\$class" => "agu.fit.lhanh.TransferCommodity",
                        "commodity" => "resource:agu.fit.lhanh.Commodity#" . $detail->tradingsymbol,
                        "issuer" => $issuer,
                        "newOwner" => $newOwner
                    ];

                    ClientAPIController::TransferCommodity("POST", '', $objData);
                    $detail->commodityparcelstatus_id = 3;
                    $detail->save();
                }
            }

            $shipment->commodityparcelstatus_id = 3;
            $shipment->save();
            return redirect()->route('supply_chain')->with('success', "Lưu thành công");
        }
        return redirect()->route('supply_chain')->with('danger', "Không tìm thấy lô hàng để xác nhận");
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

    public static function Shipping()
    {
        $shippingList = Shipment::where('commodityparcelstatus_id', '=', 2)->get();
        return $shippingList;
    }

    public static function Shipped()
    {
        $shippedList = Shipment::where('commodityparcelstatus_id', '=', 3)->get();
        return $shippedList;
    }
}
