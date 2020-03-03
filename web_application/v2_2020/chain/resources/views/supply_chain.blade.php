@extends('layouts.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header"> <i class="fa fa-tasks"></i> CHUỖI CUNG ỨNG</div>

            <div class="card-body">
                @include('layouts.blocks.flash-messages')

                @if(isset($arrCommodityByTrader))
                    @if ($arrCommodityByTrader->statusCode == 200)
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <nav>
                                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-manufacturer-tab" data-toggle="tab" href="#nav-manufacturer" role="tab" aria-controls="nav-manufacturer" aria-selected="true">Sản xuất</a>
                                        <a class="nav-item nav-link" id="nav-distributor-tab" data-toggle="tab" href="#nav-distributor" role="tab" aria-controls="nav-distributor" aria-selected="false">Vận chuyển</a>
                                        <a class="nav-item nav-link" id="nav-retailer-tab" data-toggle="tab" href="#nav-retailer" role="tab" aria-controls="nav-retailer" aria-selected="false">Phân phối</a>
                                        <a class="nav-item nav-link" id="nav-customer-tab" data-toggle="tab" href="#nav-customer" role="tab" aria-controls="nav-customer" aria-selected="false">Khách hàng</a>
                                    </div>
                                </nav>
                                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-manufacturer" role="tabpanel" aria-labelledby="nav-manufacturer-tab" width="100%">
                                        <div class="card">
                                            <div class="card-header">
                                                SẢN PHẨM TRONG KHO
                                                <a href=" {{ route('commodity_create') }} " class="btn btn-success float-right"> <strong><i class="fa fa-plus"></i> THÊM</strong></a>
                                            </div>
                                            <div class="card-body">
                                                <?php $countManufactuer = 0; ?>
                                                <table class="table table-striped table-data">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center-middle">STT</th>
                                                            <th class="text-center-middle">MÃ</th>
                                                            <th class="text-left-middle">SẢN PHẨM</th>
                                                            <th class="text-center-middle">NGÀY ĐÓNG GÓI</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($arrCommodityByTrader->commodityForManufactuer as $key => $commodity)
                                                            <?php $urlTrace = route('trace', ['code'=>$commodity->tradingSymbol]); ?>
                                                            <tr>
                                                                <td class="text-center-middle">{{++$countManufactuer}}</td>
                                                                <td class="text-center-middle">
                                                                    <img src="https://chart.googleapis.com/chart?cht=qr&chl={{$urlTrace}}&chs=160x160&chld=L|0" width="65">
                                                                    <br>
                                                                    {{$commodity->tradingSymbol}}
                                                                </td>
                                                                <td class="text-left-middle">
                                                                    {{$commodity->name}}
                                                                </td>
                                                                <td class="text-center-middle">
                                                                    {{date('d/m/Y', strtotime($commodity->dateProduct))}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="nav-distributor" role="tabpanel" aria-labelledby="nav-distributor-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                LÔ HÀNG ĐANG VẬN CHUYỂN
                                                <a href="{{route('shipment_create')}}" class="btn btn-success float-right"> <strong><i class="fa fa-plus"></i> THÊM VẬN CHUYỂN </strong></a>
                                            </div>
                                            <div class="card-body">

                                                <?php $countShip = 0; ?>
                                                <table class="table table-striped table-data">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center-middle">STT</th>
                                                            <th class="text-center-middle">NGÀY</th>
                                                            <th class="text-left-middle">HOẠT ĐỘNG</th>
                                                            <th class="text-center-middle">SỐ LƯỢNG</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($shippingList as $key => $shipping)
                                                            <tr>
                                                                <td class="text-center-middle">{{++$countShip}}</td>

                                                                <td class="text-center-middle">
                                                                    {{date('d/m/Y', strtotime($shipping->created_at))}}
                                                                </td>
                                                                <td class="text-left-middle">
                                                                    {{App\Http\Controllers\ServiceController::GetDistributorName($shipping->sourceparticipantid)}}
                                                                    <i class="fa fa-long-arrow-alt-right"></i>
                                                                    {{App\Http\Controllers\ServiceController::GetRetailerName($shipping->destinationparticipantid)}}
                                                                </td>

                                                                <td class="text-center-middle">
                                                                    {{count($shipping->shipmentdetail)}}
                                                                </td>

                                                                <td class="text-center-middle">
                                                                    <!-- <a href="" class="btn btn-success" title="Xác nhận đã chuyển xong"> <i class="fa fa-check-square"></i> </a> -->
                                                                    <form action="{{route('shipment_delivered')}}" method="POST">
                                                                        @method('PUT')
                                                                        @csrf
                                                                        <input type="hidden" name="id" value="{{$shipping->id}}">
                                                                        <a href="" class="btn btn-info" title="Xem thông tin chi tiết"> <i class="fa fa-info-circle"></i> </a>
                                                                        <button type="submit" class="btn btn-success" title="Xác nhận đã chuyển xong"><i class="fa fa-check-square"></i></button>               
                                                                    </form>
                                                                    
                                                                </td>
                                                                
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>

                                                <!-- <?php $countDistributor = 0; ?>
                                                <table class="table table-striped table-data">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center-middle">STT</th>
                                                            <th class="text-center-middle">MÃ</th>
                                                            <th class="text-left-middle">SẢN PHẨM</th>
                                                            <th class="text-center-middle">NGÀY ĐÓNG GÓI</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($arrCommodityByTrader->commodityForDistributor as $key => $commodity)
                                                            <?php $urlTrace = route('trace', ['code'=>$commodity->tradingSymbol]); ?>
                                                            <tr>
                                                                <td class="text-center-middle">{{++$countDistributor}}</td>
                                                                <td class="text-center-middle">
                                                                    <img src="https://chart.googleapis.com/chart?cht=qr&chl={{$urlTrace}}&chs=160x160&chld=L|0" width="65">
                                                                    <br>
                                                                    {{$commodity->tradingSymbol}}
                                                                </td>
                                                                <td class="text-left-middle">
                                                                    {{$commodity->name}}
                                                                </td>
                                                                <td class="text-center-middle">
                                                                    {{date('d/m/Y', strtotime($commodity->dateProduct))}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="nav-retailer" role="tabpanel" aria-labelledby="nav-retailer-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                HÀNG HÓA ĐANG Ở NHÀ PHÂN PHỐI - BÁN LẺ
                                                <a href="" class="btn btn-success float-right"> <strong><i class="fa fa-shopping-cart"></i> Bán  </strong></a>
                                            </div>
                                            <div class="card-body">
                                                <?php $countRetailer = 0; ?>
                                                <table class="table table-striped table-data">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center-middle">STT</th>
                                                            <th class="text-center-middle">MÃ</th>
                                                            <th class="text-left-middle">SẢN PHẨM</th>
                                                            <th class="text-center-middle">NGÀY ĐÓNG GÓI</th>
                                                            <th class="text-left-middle">NHÀ PHÂN PHỐI - BÁN LẺ</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($arrCommodityByTrader->commodityForRetailer as $key => $commodity)
                                                            <?php $urlTrace = route('trace', ['code'=>$commodity->tradingSymbol]); ?>
                                                            <tr>
                                                                <td class="text-center-middle">{{++$countRetailer}}</td>
                                                                <td class="text-center-middle">
                                                                    <img src="https://chart.googleapis.com/chart?cht=qr&chl={{$urlTrace}}&chs=160x160&chld=L|0" width="65">
                                                                    <br>
                                                                    {{$commodity->tradingSymbol}}
                                                                </td>
                                                                <td class="text-left-middle">
                                                                    {{$commodity->name}}
                                                                </td>
                                                                <td class="text-center-middle">
                                                                    {{date('d/m/Y', strtotime($commodity->dateProduct))}}
                                                                </td>
                                                                <td class="text-left-middle">
                                                                    {{App\Http\Controllers\ServiceController::ConvertResourceToCompanyName($commodity->owner)}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="nav-customer" role="tabpanel" aria-labelledby="nav-customer-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                HÀNG HÓA ĐÃ BÁN CHO KHÁCH HÀNG
                                            </div>
                                            <div class="card-body">
                                                <?php $countCustomer = 0; ?>
                                                <table class="table table-striped table-data">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center-middle">STT</th>
                                                            <th class="text-center-middle">MÃ</th>
                                                            <th class="text-left-middle">SẢN PHẨM</th>
                                                            <th class="text-center-middle">NGÀY ĐÓNG GÓI</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($arrCommodityByTrader->commodityForCustomer as $key => $commodity)
                                                            <?php $urlTrace = route('trace', ['code'=>$commodity->tradingSymbol]); ?>
                                                            <tr>
                                                                <td class="text-center-middle">{{++$countCustomer}}</td>
                                                                <td class="text-center-middle">
                                                                    <img src="https://chart.googleapis.com/chart?cht=qr&chl={{$urlTrace}}&chs=160x160&chld=L|0" width="65">
                                                                    <br>
                                                                    {{$commodity->tradingSymbol}}
                                                                </td>
                                                                <td class="text-left-middle">
                                                                    {{$commodity->name}}
                                                                </td>
                                                                <td class="text-center-middle">
                                                                    {{date('d/m/Y', strtotime($commodity->dateProduct))}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center">
                            <img src="{{URL::asset('images/smile.png')}}" width="100px" alt="">
                            <br> <br>
                            <h4> Không kết nối được tới hệ thống blockchain!</h4>
                            <br>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection