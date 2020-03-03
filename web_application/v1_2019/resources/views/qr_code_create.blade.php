@extends('layouts.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header"> <i class="fa fa-qrcode"></i>
                TẠO MÃ QR
            </div>

            <div class="card-body">
                @include('layouts.blocks.flash-messages')
                <form action="{{route('qrcode_store')}}" method="post">
                    @csrf
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8 col-xl-6 offset-md-1 offset-lg-2 offset-xl-3">
                        <div class="row">
                            <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 col-xl-4">
                                <label for=""> Số lượng tem cần tạo </label>
                            </div>
                            <div class="col-xs-12 col-sm-7 col-md-8 col-lg-8 col-xl-8">
                                <input type="number" name="qrcode_quantity" min="1" class="form-control" placeholder="Số lượng tem cần tạo">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary"> <strong> <i class="fa fa-cogs"></i> TẠO TEM  </strong> </button>
                    </div>
                    <br><br><br>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection