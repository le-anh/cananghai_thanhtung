<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public static function ConvertResourceToLabelTimeLine($resource="")
    {
        if(empty($resource))
            return "";
        $arrTradeTypeAndCompanyName = self::SplitResourceToTraderTypeAndCompanyName($resource);
        return (object) self::ConvertArrTradeTypeAndCompanyNameToActionAndCompanyName($arrTradeTypeAndCompanyName);
    }

    public static function ConvertResourceToCompanyName($resource="")
    {
        if(empty($resource))
            return "Unknown";
        $arrTradeTypeAndCompanyName = self::SplitResourceToTraderTypeAndCompanyName($resource);
        $arrActionAndCompanyName = (object) self::ConvertArrTradeTypeAndCompanyNameToActionAndCompanyName($arrTradeTypeAndCompanyName);
        return $arrActionAndCompanyName->companyName;
    }

    public static function SplitResourceToTraderTypeAndCompanyName($resource)
    {
        $indexOfTrader = strripos($resource, '.') + 1;
        $indexOfSharp = strripos($resource, '#');
        $lenString = strlen($resource);
        $lenOfTrader = $indexOfSharp - $indexOfTrader;
        $lenOfTradeId = $lenString - $indexOfSharp - 1;
        $strTrader = substr($resource, $indexOfTrader, $lenOfTrader);
        $tradeId = substr($resource, $indexOfSharp + 1, $lenOfTradeId);
        return array('tradeType' => $strTrader, 'tradeId' => $tradeId);
    }

    public static function SplitResourceToTraderType($resource)
    {
        $indexOfTrader = strripos($resource, '.') + 1;
        $indexOfSharp = strripos($resource, '#');
        $lenOfTrader = $indexOfSharp - $indexOfTrader;
        $strTrader = substr($resource, $indexOfTrader, $lenOfTrader);
        return $strTrader;
    }

    public static function ConvertArrTradeTypeAndCompanyNameToActionAndCompanyName($arrTradeTypeAndCompanyName = null)
    {
        $actionTransaction = "";
        $companyName = "";
        $objTradeTypeAndCompanyName = ((object) $arrTradeTypeAndCompanyName);
        $tradeType = $objTradeTypeAndCompanyName->tradeType;
        $tradeId = $objTradeTypeAndCompanyName->tradeId;
        $response;

        switch (strtoupper($tradeType)) {
            case 'MANUFACTURER':
                $actionTransaction = "Sản xuất - Đóng gói";
                $response = ClientAPIController::Manufacturer("GET", $tradeId, "");
                break;
            
            case 'DISTRIBUTOR':
                $actionTransaction = "Chuyển hàng";
                $response = ClientAPIController::Distributor("GET", $tradeId, "");
                break;

            case 'RETAILER':
                $actionTransaction = "Đến nhà phân phối - bán lẻ";
                $response = ClientAPIController::Retailer("GET", $tradeId, "");
                break;

            case 'CUSTOMER':
                $actionTransaction = "Đã bán cho khách hàng";
                $response = ClientAPIController::Customer("GET", $tradeId, "");
                break;
            
            default:
                $actionTransaction = "#";
                break;
        }

        if($response)
            if($response->getStatusCode() == 200)
                $companyName = json_decode($response->getBody())->companyName;

        return array('actionTransaction' => $actionTransaction, 'companyName' => $companyName);
    }


    public static function PreProcessCompanyName($response = null)
    {
        if($response)
            if($response->getStatusCode() == 200)
                return json_decode($response->getBody())->companyName;
        return "Unknown";
    }

    public static function GetDistributorName($tradeId = '')
    {
        $response = ClientAPIController::Distributor('GET', $tradeId, '');
        return self::PreProcessCompanyName($response);
    }
    
    public static function GetRetailerName($tradeId = '')
    {
        $response = ClientAPIController::Retailer('GET', $tradeId, '');
        return self::PreProcessCompanyName($response);
    }

    public static function RandomNum($len)
    {
    	$randomNum = substr(str_shuffle("0123456789"), 0, $len);
    	return $randomNum;
    }
}
