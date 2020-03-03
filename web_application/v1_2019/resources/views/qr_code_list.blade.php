@extends('layouts.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header"> <i class="fa fa-qrcode"></i>
                DANH SÁCH MÃ QR
                <a href="{{route('qrcode_create')}}" class="btn btn-primary float-right"> <strong> <i class="fa fa-plus"></i> TẠO QR </strong> </a>
            </div>

            <div class="card-body">
                @include('layouts.blocks.flash-messages')

                @if(isset($qrCodeList))
                    <?php $countQR = 0; ?>
                    <table class="table table-striped table-data">
                        <thead>
                            <tr>
                                <th class="text-center-middle">#</th>
                                <th class="text-center-middle">NGÀY TẠO</th>
                                <th class="text-right-middle">TỔNG SỐ LƯỢNG</th>
                                <th class="text-right-middle">ĐÃ SỬ DỤNG</th>
                                <th class="text-right-middle">CÒN LẠI</th>
                                <th class="text-center-middle"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($qrCodeList as $key => $qrCodeParcel)
                                <tr>
                                    <td class="text-center-middle">{{++$countQR}}</td>
                                    <td class="text-center-middle">
                                        {{date('d/m/Y', strtotime($qrCodeParcel->created_at))}}
                                    </td>
                                    <td class="text-right-middle">
                                        {{$qrCodeParcel->qrcodebarparceltotal}}
                                    </td>
                                    <td class="text-right-middle">
                                        {{$qrCodeParcel->qrcodebarparceltotal - $qrCodeParcel->qrcodeavaliable}}
                                    </td>
                                    <td class="text-right-middle">
                                        <span class="badge badge-info"> {{$qrCodeParcel->qrcodeavaliable}} </span>
                                    </td>
                                    <td class="text-center-middle">
                                        <form action="{{route('qrcode_export')}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="idqrcodeparcel" value="{{$qrCodeParcel->id}}">
                                            <button type="submit" class="btn btn-success" title="Tải bảng qr"><i class="fa fa-download"></i> Tải bảng in </button>
                                            <a href="{{route('qrcode_update_used', ['id'=>$qrCodeParcel->id])}}" class="btn btn-danger" title="Xóa (đã dùng hết tem)"><i class="fa fa-trash"></i> Đã dùng hết </a>
                                        </form>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center">
                        <img src="{{URL::asset('images/smile.png')}}" width="100px" alt="">
                        <br> <br>
                        <h4> Không kết nối được tới hệ thống blockchain!</h4>
                        <br>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection