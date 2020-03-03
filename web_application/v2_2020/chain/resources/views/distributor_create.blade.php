@extends('layouts.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header"> <i class="fa fa-shipping-fast"></i>
                THÊM NHÀ VẬN CHUYỂN
                <a href="{{route('distributor_index')}}" class="btn btn-info float-right"> <strong> <i class="fa fa-undo"></i> DANH SÁCH NHÀ VẬN CHUYỂN </strong> </a>
            </div>

            <div class="card-body">

				<div class="col-xs-12 col-sm-12 col-md-10 col-lg-8 col-xl-6 offset-md-1 offset-lg-2 offset-xl-3">
					<form action="{{route('distributor_store')}}" method="POST">
						@csrf
						@include('layouts.blocks.flash-messages')
						@if ($errors->all())
							<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								 - Lưu không thành công.
								 <br>
								 - Vui lòng kiểm tra những ô gợi ý màu đỏ.
							</div>
						@endif
						
						<div class="form-group row">
							<label for="companyname" class="col-sm-4 col-form-label">Tên (*)</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="companyname" name="companyname" placeholder="Tên nhà vận chuyển">
								<div class="text-danger">{{$errors->has('companyname') ? $errors->first('companyname'):''}}</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="province" class="col-sm-4 col-form-label">Thành phố/Tỉnh</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="province" name="province" placeholder="Thành phố/Tỉnh">
							</div>
						</div>
						<div class="form-group row">
							<label for="city" class="col-sm-4 col-form-label">Thành phố/Quận/Huyện</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="city" name="city" placeholder="Thành phố/Quận/Huyện">
							</div>
						</div>
						<div class="form-group row">
							<label for="town" class="col-sm-4 col-form-label">Phường/Thị trấn/Xã</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="town" name="town" placeholder="Phường/Thị trấn/Xã">
							</div>
						</div>
						<div class="form-group row">
							<label for="apartmentnum" class="col-sm-4 col-form-label">Địa chỉ</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="apartmentnum" name="apartmentnum" placeholder="Số nhà - Đường, Khóm/Ấp">
							</div>
						</div>
						<div class="text-center">
							<button type="reset" class="btn btn-secondary"> <strong> <i class="fa fa-sync"></i> HỦY </strong> </button>
							<button type="submit" class="btn btn-primary"> <strong> <i class="fa fa-save"></i> LƯU </strong> </button>
						</div>
					</form>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection