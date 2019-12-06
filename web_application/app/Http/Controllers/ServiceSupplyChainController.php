<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceSupplyChainController extends Controller
{
    public function supplychain()
    {
        $response = ClientAPIController::Commodity();
        if($response)
        {
            if($response->getStatusCode() == 200)
            {
                $arrCommodityByTrader = self::SplitCommodityByTrader(json_decode($response->getBody()));
                $arrCommodityByTrader['statusCode'] = 200;
            }
            else
                $arrCommodityByTrader = array('statusCode'=>$response->getStatusCode());
            
        }
        else
            $arrCommodityByTrader = array('statusCode'=>500);
        $shippingList = ShipmentController::Shipping();
            
        return view('supply_chain', ['arrCommodityByTrader'=> (object) $arrCommodityByTrader, 'shippingList'=>$shippingList]);
    }

    public function SplitCommodityByTrader($arrCommodity = null)
    {
        $arrCommodityForManufactuer = array();
        $arrCommodityForDistributor = array();
        $arrCommodityForRetailer = array();
        $arrCommodityForCustomer = array();

        foreach ($arrCommodity as $key => $commodity) {
            $traderType = ServiceController::SplitResourceToTraderType($commodity->owner);
            switch (strtoupper($traderType)) {
                case 'MANUFACTURER':
                    array_push($arrCommodityForManufactuer, $commodity);
                    break;
                
                case 'DISTRIBUTOR':
                    array_push($arrCommodityForDistributor, $commodity);
                    break;
    
                case 'RETAILER':
                    array_push($arrCommodityForRetailer, $commodity);
                    break;
    
                case 'CUSTOMER':
                    array_push($arrCommodityForCustomer, $commodity);
                    break;
                
                default:
                    array_push($arrCommodityForManufactuer, $commodity);
                    break;
            }
        }
        $arrResult = array(
            'statusCode' => 200,
            'commodityForManufactuer' => $arrCommodityForManufactuer, 
            'commodityForDistributor' => $arrCommodityForDistributor,
            'commodityForRetailer' => $arrCommodityForRetailer,
            'commodityForCustomer' => $arrCommodityForCustomer
        );
        return $arrResult;
    }
}
