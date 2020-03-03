<?php

namespace App\Http\Controllers;

use App\QrCodeParcel;
use Illuminate\Http\Request;
use DB;
use PDF;
use App\QrCode;

class QrCodeParcelController extends Controller
{
    const NUM_TEMP_PER_PAGE = 88;
    const LEN_SUF_QRCODE = 4;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qrCodeList = DB::table('qrcodebar')
            -> leftJoin('qrcodebarparcel','qrcodebar.qrcodebarparcel_id', '=', 'qrcodebarparcel.id')
            -> where ('qrcodebarparcel.trangthaiqrcodebarparcel', '=', '1')
            -> select('qrcodebarparcel.id', 'qrcodebarparcel.parcelcode', 'qrcodebarparcel.created_at' , DB::raw('count(qrcodebar.id) as qrcodebarparceltotal, SUM(CASE WHEN qrcodebar.trangthaiqrcodebar_id=1 THEN 1 ELSE 0 END) as qrcodeavaliable'))
            -> groupBy('qrcodebar.qrcodebarparcel_id', 'qrcodebarparcel.parcelcode')
            -> orderBy('qrcodebarparcel.created_at', 'desc')
            -> get();

        return view('qr_code_list', ['qrCodeList'=>$qrCodeList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('qr_code_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $qrCodeQuantity = intval(($request->qrcode_quantity));
        if($qrCodeQuantity > 0)
        {
            try {
                $qrCodeBarParcel = new QRCodeParcel();
                $qrCodeBarParcel->trangthaiqrcodebarparcel = 1;
                $qrCodeBarParcel->save();

                $qrCodeBarParcel->parcelcode = self::ChuanHoaParcelCode($qrCodeBarParcel->id);
                $qrCodeBarParcel->save();

                $qrCodeQuantity_RealCreate = self::QRCodeQuantityRealCreate($qrCodeQuantity);

                $stt = intval(QRCode::max('stt'));

                for ($i=0; $i < $qrCodeQuantity_RealCreate; $i++) { 
                    $qRCodeBar = new QRCode();
                    $qRCodeBar->qrcodebarparcel_id = $qrCodeBarParcel->id;
                    $qRCodeBar->stt = ++$stt;
                    $qRCodeBar->maqr = self::GenerateQRCode($qrCodeBarParcel->parcelcode);
                    $qRCodeBar->trangthaiqrcodebar_id = 1;
                    $qRCodeBar->save();
                }
            } catch (\Throwable $th) {
                //throw $th;
                return redirect()->back()->with('danger', "Tạo không thành công.<br>". $th->getMessage());
            }
        }
        else
        {
            return redirect()->back()->with('warning', "Vui lòng nhập số lượng > 0");
        }

        return redirect()->route('qrcode_index')->with('success', 'Tạo và lưu qr code thành công!' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QrCodeParcel  $qrCodeParcel
     * @return \Illuminate\Http\Response
     */
    public function show(QrCodeParcel $qrCodeParcel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QrCodeParcel  $qrCodeParcel
     * @return \Illuminate\Http\Response
     */
    public function edit(QrCodeParcel $qrCodeParcel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QrCodeParcel  $qrCodeParcel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QrCodeParcel $qrCodeParcel)
    {
        //
    }

    public function updatesusedtatus($idParcel)
    {
        $qrCodeParcel = QRCodeParcel::find($idParcel);

        if($qrCodeParcel)
        {
            $qrCodeParcel->trangthaiqrcodebarparcel = 2;
            $qrCodeParcel->save();
            return redirect()->route('qrcode_index')->with('success', 'Lưu thành công!' );
        }

        return redirect()->route('qrcode_index')->with('warning', 'Có lỗi trong quá trình lưu.<br>Vui lòng thử lại' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QrCodeParcel  $qrCodeParcel
     * @return \Illuminate\Http\Response
     */
    public function destroy(QrCodeParcel $qrCodeParcel)
    {
        //
    }

    public function export(Request $request)
    {
        $idQRCodeBarParcel = $request->idqrcodeparcel;
        $qrCodeParcel = QRCodeParcel::find($idQRCodeBarParcel);
        if($qrCodeParcel)
        {
            $malotem = $qrCodeParcel->parcelcode;
            $dateCreateQRCodeBar = $qrCodeParcel->created_at;
        }
        else
            return redirect()->route('qrcodebar-list')->with('warning', 'Không tìm thấy dữ liệu. Vui lòng refresh (hoặc nhấn phím F5) để tải lại trang và thử lại.' );


        $dsQRCodeBar = QRCode::where('qrcodebarparcel_id', '=',$idQRCodeBarParcel)->get();

        if($dsQRCodeBar)
        {
            $dateCreateQRCodeBar = date('d-m-y', strtotime($dateCreateQRCodeBar));// Carbon::createFromFormat('Y-m-d h:i:s', $dateCreateQRCodeBar)->format('d-m-Y');
            
            $pdf = PDF::loadView('qr_code_export', ['dsQRCodeBar' => $dsQRCodeBar, 'malotem'=>$malotem],
                [
                    'mode'              => 'utf-8',
                    'format'           => 'A4',
                    'author'           => 'Hoang Anh',
                    'display_mode'     => 'fullpage',
                    'margin_left'       => '0.5',
                    'margin_right'      => '0.0',
                    'margin_top'        => '0.5',
                    'margin_bottom'     => '0.5'
                ]);
            return $pdf->download('qrcode_'. $dateCreateQRCodeBar . '.pdf');
        }
        else
            return redirect()->route('qrcodebar-list')->with('warning', 'Không tìm thấy dữ liệu. Vui lòng refresh (hoặc nhấn phím F5) để tải lại trang và thử lại.' );
    }

    public function GenerateQRCode($parcelCode)
    {
        while (1) {
            $sufQRCode = ServiceController::RandomNum(self::LEN_SUF_QRCODE);
            $fullQRCode = $parcelCode . $sufQRCode;
            if(count(QRCode::where('maqr', $fullQRCode)->get()) == 0)
                return $fullQRCode;
        }
    }

    public function ChuanHoaParcelCode($value='')
    {
        if(intval($value) < 10)
            return "0000".$value;
        
        if(intval($value) < 100)
            return "000".$value;

        if(intval($value) < 1000)
            return "00".$value;

        if(intval($value) < 10000)
            return "0".$value;

        return $value;
    }

    public function QRCodeQuantityRealCreate($qrCodeQuantity)
    {
        $quantity = intval($qrCodeQuantity / self::NUM_TEMP_PER_PAGE);
        if(($qrCodeQuantity % self::NUM_TEMP_PER_PAGE) > 0)
            $quantity += intval(1);

        return $quantity * self::NUM_TEMP_PER_PAGE;
    }

    public function isExistQRCodeBar($valueArr)
    {
        try {
            foreach ($valueArr as $key => $value) {
                if(QRCodeBar::find($value))
                    return true;
            }
        } catch (Exception $e) {
            
            return false;
        }

        return false;
    }
}
