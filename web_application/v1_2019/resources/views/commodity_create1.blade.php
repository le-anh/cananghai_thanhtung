<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href=" {{ URL::asset('assets_wizard/img/apple-icon.png')}} ">
	<link rel="icon" type="image/png" href=" {{ URL::asset('assets_wizard/img/favicon.png') }} ">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Get Shit Done Bootstrap Wizard by Creative Tim</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

	<!--     Fonts and icons     -->
    <link href=" {{URL::asset('css/fontawesome/css/all.css')}} " rel="stylesheet">


	<!-- CSS Files -->
    <link href=" {{ URL::asset('assets_wizard/css/bootstrap.min.css') }}" rel="stylesheet" />
	<link href=" {{ URL::asset('assets_wizard/css/gsdk-bootstrap-wizard.css') }}" rel="stylesheet" />

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href=" {{ URL::asset('assets_wizard/css/demo.css') }}" rel="stylesheet" />
</head>

<body>
<div class="image-container set-full-height" style="background-image: url(' {{ URL::asset('assets_wizard/img/wizard.jpg') }}">
    <!--   Big container   -->
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <!--      Wizard container        -->
                <div class="wizard-container">
                    <div class="card wizard-card" data-color="orange" id="wizardProfile">
                        <form action="" method="">
                            <!--        You can switch ' data-color="orange" '  with one of the next bright colors: "blue", "green", "orange", "red"          -->
                            <div class="wizard-header">
                                <h3>
                                KHAI BÁO THÊM MỚI HÀNG HÓA <br>
                                <!-- <small>This information will let us know more about you.</small> -->
                                </h3>
                            </div>

                            <div class="wizard-navigation">
                                <ul>
                                    <li><a href="#about" data-toggle="tab">LOẠI HÀNG</a></li>
                                    <li><a href="#account" data-toggle="tab">CÁCH NHẬP QR</a></li>
                                    <li><a href="#address" data-toggle="tab">QR CODE</a></li>
                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane" id="about">
                                    <div class="row">
                                        <h4 class="info-text"> Chọn loại hàng cần tạo?</h4>
                                        <div class="row">
                                            <div class="col-sm-10 col-sm-offset-1">
                                                <div class="col-sm-6">
                                                    <div class="choice" data-toggle="wizard-radio">
                                                        <input type="radio" name="jobb" value="1">
                                                        <img src="{{ URL::asset('images/products/chacarutxuong.jpg') }}" class="icon" width="100%" alt="">
                                                        <h6> Chả cá rút xương </h6>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="choice" data-toggle="wizard-radio">
                                                        <input type="radio" name="jobb" value="2">
                                                        <img src="{{ URL::asset('images/products/chacatamuop.jpg') }}" class="icon" width="100%" alt="">
                                                        <h6> Chả cá tẩm gia vị </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="account">
                                    <h4 class="info-text"> Quét mã qr hay nhập số thứ tự? </h4>
                                    <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <div class="col-sm-6">
                                                <div class="choice" data-toggle="wizard-radio">
                                                    <input type="radio" name="jobb" value="Quet">
                                                    <div class="icon">
                                                        <i class="fa fa-qrcode"></i>
                                                    </div>
                                                    <h6>Quét mã qr</h6>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="choice" data-toggle="wizard-radio">
                                                    <input type="radio" name="jobb" value="SoThuTu">
                                                    <div class="icon">
                                                        <i class="fa fa-sort-numeric-up-alt"></i>
                                                    </div>
                                                    <h6>Nhập số thứ tự</h6>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane" id="address">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4 class="info-text"> Are you living in a nice area? </h4>
                                        </div>
                                        <div class="col-sm-7 col-sm-offset-1">
                                            <div class="form-group">
                                                <label>Street Name</label>
                                                <input type="text" class="form-control" placeholder="5h Avenue">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Street Number</label>
                                                <input type="text" class="form-control" placeholder="242">
                                            </div>
                                        </div>
                                        <div class="col-sm-5 col-sm-offset-1">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" class="form-control" placeholder="New York...">
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Country</label><br>
                                                <select name="country" class="form-control">
                                                    <option value="Afghanistan"> Afghanistan </option>
                                                    <option value="Albania"> Albania </option>
                                                    <option value="Algeria"> Algeria </option>
                                                    <option value="American Samoa"> American Samoa </option>
                                                    <option value="Andorra"> Andorra </option>
                                                    <option value="Angola"> Angola </option>
                                                    <option value="Anguilla"> Anguilla </option>
                                                    <option value="Antarctica"> Antarctica </option>
                                                    <option value="...">...</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wizard-footer height-wizard">
                                <div class="pull-right">
                                    <input type='button' class='btn btn-next btn-fill btn-warning btn-wd btn-sm' name='next' value='Next' />
                                    <input type='button' class='btn btn-finish btn-fill btn-warning btn-wd btn-sm' name='finish' value='Finish' />

                                </div>

                                <div class="pull-left">
                                    <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Previous' />
                                </div>
                                <div class="clearfix"></div>
                            </div>

                        </form>
                    </div>
                </div> <!-- wizard container -->
            </div>
        </div><!-- end row -->
    </div> <!--  big container -->

</div>

</body>
    @include('layouts.blocks.header-nav')

	<!--   Core JS Files   -->
	<script src=" {{ URL::asset('assets_wizard/js/jquery-2.2.4.min.js') }} " type="text/javascript"></script>
	<script src=" {{ URL::asset('assets_wizard/js/bootstrap.min.js') }} " type="text/javascript"></script>
	<script src=" {{ URL::asset('assets_wizard/js/jquery.bootstrap.wizard.js') }} " type="text/javascript"></script>

	<!--  Plugin for the Wizard -->
	<script src=" {{ URL::asset('assets_wizard/js/gsdk-bootstrap-wizard.js') }} "></script>

	<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
	<script src=" {{ URL::asset('assets_wizard/js/jquery.validate.min.js') }} "></script>
</html>
