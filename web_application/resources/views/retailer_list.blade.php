@extends('layouts.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header"> <i class="fa fa-store"></i>
                DANH SÁCH NHÀ PHÂN PHỐI - BÁN LẺ
                <a href="{{route('retailer_create')}}" class="btn btn-primary float-right"> <strong> <i class="fa fa-plus"></i> THÊM NHÀ PHÂN PHỐI - BÁN LẺ </strong> </a>
            </div>

            <div class="card-body">
                @include('layouts.blocks.flash-messages')

                @if(isset($retailerList))
                    <?php $countRetailer = 0; ?>
                    <table class="table table-striped table-data">
                        <thead>
                            <tr>
                                <th class="text-center-middle">#</th>
                                <th class="text-left-middle">NHÀ PHÂN PHỐI</th>
                                <th class="text-left-middle">ĐỊA CHỈ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($retailerList as $key => $retailer)
                                <tr>
                                    <td class="text-center-middle">{{++$countRetailer}}</td>
                                    <td class="text-left-middle">
                                        {{$retailer->companyName}}
                                    </td>
                                    <td class="text-left-middle">
                                        {{$retailer->address->apartmentnum}}, 
                                        {{$retailer->address->town}},
                                        {{$retailer->address->district}},
                                        {{$retailer->address->province}}
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