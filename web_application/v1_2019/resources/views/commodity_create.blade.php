@extends('layouts.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <!-- <div class="card">
            <div class="card-header"> <strong> CHUỖI CUNG ỨNG </strong> </div>
            <div class="card-body"> -->
                <form action="{{route('commodity_store')}}" method="post">
                    @csrf
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8 col-xl-6 offset-md-1 offset-lg-2 offset-xl-3">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            @include('layouts.blocks.flash-messages')
                            <nav>
                                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-cate-tab" data-toggle="tab" href="#nav-cate" role="tab" aria-controls="nav-cate" aria-selected="true">Loại hàng</a>
                                    <a class="nav-item nav-link" id="nav-qr-option-tab" data-toggle="tab" href="#nav-qr-option" role="tab" aria-controls="nav-qr-option" aria-selected="false">Cách nhập qr</a>
                                    <a class="nav-item nav-link" id="nav-qr-tab" data-toggle="tab" href="#nav-qr" role="tab" aria-controls="nav-qr" aria-selected="false">Thông tin qr</a>
                                </div>
                            </nav>
                            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-cate" role="tabpanel" aria-labelledby="nav-cate-tab" width="100%">
                                    <div class="text-center">
                                        <h4> Chọn loại hàng hóa? </h4>
                                        <input type="radio" name="cate" id="cate_1" value="1" style="display:none;">
                                        <label class="" for="cate_1" style="padding:20px;">
                                            <img src=" {{URL::asset('images/products/chacarutxuong.jpg')}} " id="cate_1_img" width="64px;" class="rounded-circle img-cate " alt="Cinque Terre">
                                            <br>
                                            <strong> Chả cá rút xương </strong>
                                        </label>
                                        <input type="radio" name="cate" id="cate_2" value="2" style="display:none;">
                                        <label class="" for="cate_2" style="padding:20px;">
                                            <img src=" {{URL::asset('images/products/chacatamuop.jpg')}} " id="cate_2_img" width="64px;" class="rounded-circle img-cate " alt="Cinque Terre">
                                            <br>
                                            <strong> Chả cá tẩm gia vị </strong>
                                        </label>
                                        <div id="text_alert_cate" class="text-danger"></div>
                                    </div>

                                    <div style="padding:5px;">
                                        <a href="" class="btn btn-info float-right btn-next-qr-option">Tiếp tục <i class="fa fa-arrow-alt-circle-right"></i> </a>
                                        <br>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-qr-option" role="tabpanel" aria-labelledby="nav-qr-option-tab">
                                    <div class="text-center">
                                        <h4> Chọn cách nhập qr? </h4>
                                        <div class="form-group">
                                            <input type="radio" name="tuychon" id="rb1" value="1" style="display:none;">
                                            <input type="radio" name="tuychon" id="rb2" value="2" style="display:none;">
                                            <label for="rb1" style="padding:20px;">
                                                <img src=" {{URL::asset('images/products/chacarutxuong.jpg')}} " id="rb1img" width="64px;" class="rounded-circle img-border-orange qr_option_img" alt="">
                                                <br>
                                                <strong> Quét mã qr </strong>
                                            </label>

                                            <label for="rb2" style="padding:20px;">
                                                <img src=" {{URL::asset('images/products/chacarutxuong.jpg')}} " id="rb2img" width="64px;" class="rounded-circle qr_option_img" alt="">
                                                <br>
                                                <strong> Nhập số thứ tự </strong>
                                            </label>
                                            <div id="text_alert_qr_option" class="text-danger"></div>
                                        </div>

                                    </div>


                                    <div style="padding:5px;">
                                        <a href="" class=" btn btn-secondary btn-previous-cate"> <i class="fa fa-arrow-alt-circle-left"></i> Về trước </a>
                                        <a href="" class="btn btn-info float-right btn-next-qr"> Tiếp tục <i class="fa fa-arrow-alt-circle-right"></i> </a>
                                        <br>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-qr" role="tabpanel" aria-labelledby="nav-qr-tab">
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10 offset-xs-1 offset-sm-1 offset-md-1 offset-lg-1 offset-xl-1">
                                        <div class="" id="qrscan">
                                            <div class="form-group">
                                                <label for="qrstart">Mã qr đầu</label>
                                                <input type="text" name="qrstart" id="qrstart" class="form-control" placeholder="Quét mã qr đầu">
                                                <div class="text-dangger" id="text-alert-qr-scan"></div>
                                            </div>

                                            <div class="form-group">
                                                <label for="qrend">Mã qr cuối</label>
                                                <input type="text" name="qrend" id="qrend" class="form-control" placeholder="Qué mã qr cuối">
                                            </div>
                                        </div>

                                        <div class="hidden" id="qrnum" hidden="true">
                                            <div class="form-group">
                                                <label for="numqrstart">Số thứ tự tem đầu</label>
                                                <input type="number" name="numqrstart" id="numqrstart" class="form-control" placeholder="Số thứ tự tem đầu">
                                                <div class="text-danger" id="text-alert-qr_num"></div>
                                            </div>

                                            <div class="form-group">
                                                <label for="numqrend">Số thứ tự tem cuối</label>
                                                <input type="number" name="numqrend" id="numqrend" class="form-control" placeholder="Số thứ tự tem cuối">
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <div style="padding:5px;">
                                        <a href="" class=" btn btn-secondary btn-previous-qr-option"> <i class="fa fa-arrow-alt-circle-left"></i> Về trước </a>
                                        <button type="submit" class="btn btn-info float-right btn-save"> <i class="fa fa-save"></i> Lưu (hoàn thành) </button>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <!-- </div>
        </div> -->
    </div>
</div>
@endsection

@section('javascript')
    @parent
    <script>
        $('input:radio[name="cate"]').change(function() {
            var inputValue = $(this).attr("id");
            $('.img-cate').removeClass('img-border-orange');
            $('#'+inputValue+"_img").addClass('img-border-orange');
        });

        $('input:radio[name="tuychon"]').change(function() {
            var inputValue = $(this).attr("id");
            $('.qr_option_img').removeClass('img-border-orange');
            $('#'+inputValue+"img").addClass('img-border-orange');
            if(inputValue == "rb1")
            {
                $('#qrscan').removeClass('hidden');
                $('#qrscan').removeAttr('hidden');
                $('#qrnum').addClass('hidden');
                $('#qrnum').attr('hidden', 'true');
            }
            else
            {
                $('#qrnum').removeClass('hidden');
                $('#qrnum').removeAttr('hidden');
                $('#qrscan').addClass('hidden');
                $('#qrscan').attr('hidden', 'true');
            }
        });

        $('.btn-next-qr-option').click(function(e){
            e.stopPropagation();
            e.preventDefault();
            if(ValidateCate())
            {
                $('.nav-item').removeClass('active');
                $('.nav-item').attr('aria-selected', 'false');
                $('.tab-pane').removeClass('active');
                $('.tab-pane').removeClass('show');
                $('#nav-qr-option-tab').addClass('active');
                $('#nav-qr-option-tab').attr('aria-selected', 'true');
                $('#nav-qr-option').addClass('active');
                $('#nav-qr-option').addClass('show');
            }
        });

        $('.btn-next-qr').click(function(e){
            e.stopPropagation();
            e.preventDefault();
            if(ValidateQROption())
            {
                $('.nav-item').removeClass('active');
                $('.nav-item').attr('aria-selected', 'false');
                $('.tab-pane').removeClass('active');
                $('.tab-pane').removeClass('show');
                $('#nav-qr-tab').addClass('active');
                $('#nav-qr-tab').attr('aria-selected', 'true');
                $('#nav-qr').addClass('active');
                $('#nav-qr').addClass('show');
            }
        });

        $('.btn-previous-cate').click(function(e){
            e.stopPropagation();
            e.preventDefault();
            $('.nav-item').removeClass('active');
            $('.nav-item').attr('aria-selected', 'false');
            $('.tab-pane').removeClass('active');
            $('.tab-pane').removeClass('show');
            $('#nav-cate-tab').addClass('active');
            $('#nav-cate-tab').attr('aria-selected', 'true');
            $('#nav-cate').addClass('active');
            $('#nav-cate').addClass('show');
        });

        $('.btn-previous-qr-option').click(function(e){
            e.stopPropagation();
            e.preventDefault();
            $('.nav-item').removeClass('active');
            $('.nav-item').attr('aria-selected', 'false');
            $('.tab-pane').removeClass('active');
            $('.tab-pane').removeClass('show');
            $('#nav-qr-option-tab').addClass('active');
            $('#nav-qr-option-tab').attr('aria-selected', 'true');
            $('#nav-qr-option').addClass('active');
            $('#nav-qr-option').addClass('show');
        });

        $('.btn-save').click(function(e){
            if(!ValidateQR())
            {
                e.stopPropagation();
                e.preventDefault();
            }
        });

        function ValidateCate() {
            if($('input:radio[name="cate"]').is(':checked'))
            {
                $('#text_alert_cate').html('')
                return true;
            }
            else
            {
                $('#text_alert_cate').html('Vui lòng chọn loại hàng cần tạo')
                return false;
            }
        }

        function ValidateQROption() {
            if($('input:radio[name="qroption"]').is(':checked'))
            {
                $('#text_alert_qr_option').html('')
                return true;
            }
            else
            {
                $('#text_alert_qr_option').html('Vui lòng chọn cách nhập qr')
                return false;
            }
        }

        function ValidateQR() {
            $('#text_alert_qr_scan').html('');
            $('#text_alert_qr_num').html('');

            if($('#qrtuychon2').prop('checked', 'true'))
            {
                var urlQRStart = $('#qrstart').val();
                if(empty(urlQRStart))
                {
                    $('#text_alert_qr_scan').html('Vui lòng scan qr');
                    return false;
                }
            }

            if($('#qrtuychon2').prop('checked', 'true'))
            {
                var numQRStart = $('#numqrstart').val();
                if(empty(numQRStart))
                {
                    $('#text_alert_qr_num').html('Vui lòng nhập số tem');
                    return false;
                }
            }
            return true;
        }
    </script>
@endsection