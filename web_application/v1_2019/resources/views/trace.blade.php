<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon"  type='image/x-icon' href="{{URL::asset('images/favicon.ico')}}">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Thanh Tùng - Cá Nàng Hai') }}</title>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href=" {{URL::asset('css/fonts.nunito.css')}} " rel="stylesheet">
        <!-- Font awesome -->
        <link href=" {{URL::asset('css/fontawesome/css/all.css')}} " rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}">
        <!-- Data table -->
        <link rel="stylesheet" href="{{URL::asset('css/dataTables.bootstrap4.min.css')}}">
        <!-- My style -->
        <link rel="stylesheet" href="{{URL::asset('css/mystyle.css')}}">
        
    </head>
    <body>
        <div id="app">
            <!-- Nav Header -->
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="https://agchain.vn/cananghai/" style="color:#012A3F !important;">
                        <strong>
                            <i class="fa fa-home"></i> {{ config('app.name', 'Laravel') }}
                        </strong>
                    </a>
                </div>
            </nav>

            <!-- Content -->
            <main class="py-4">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" style="background-color:#012A3F !important; color:#A89572; font-weight:bold;"> <i class="fa fa-info-circle"></i> THÔNG TIN SẢN PHẨM</div>
                            <div class="card-body">
                                @if(isset($response))
                                    @if ($response->getStatusCode()==200)
                                        <?php $commodity = json_decode($response->getBody()); ?>
                                        @if($commodity)
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 text-center">
                                                    <img src=" {{URL::asset('images/products/chacarutxuong.jpg')}} " width="100%" class="rounded img-thumbnail" alt="Cinque Terre">
                                                    <h4> {{$commodity->name}} </h4>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                            <nav>
                                                                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Thông tin sản phẩm</a>
                                                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Thành phần</a>
                                                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Hướng dẫn sử dụng</a>
                                                                    <!-- <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">About</a> -->
                                                                </div>
                                                            </nav>
                                                            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                                                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" width="100%">
                                                                    <table class="table table-striped table-hover" width="100%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th> Mã </th>
                                                                                <td> {{$commodity->tradingSymbol}} </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th> Tên </th>
                                                                                <td> {{$commodity->name}} </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th> Ngày đóng gói </th>
                                                                                <td> {{date('d/m/Y', strtotime($commodity->dateProduct))}} </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th> Hạn sử dụng </th>
                                                                                <td> {{date('d/m/Y', strtotime("+6 months", strtotime( $commodity->dateProduct))) }} </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                                    <ul>
                                                                        <li>Cá Thát Lát (92%)</li>
                                                                        <li>Thị heo</li>
                                                                        <li>Muối</li>
                                                                        <li>Chất điều vị (E621)</li>
                                                                        <li>Tiêu</li>
                                                                        <li>Hành</li>
                                                                    </ul>

                                                                </div>
                                                                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                                                    <ol>
                                                                        <li>Rã đông tự nhiên không ngâm nước.</li>
                                                                        <li>Đổ dầu nhiều vào chảo, đun lửa cho đến khi dầu nóng để cá vào chiên giòn.</li>
                                                                        <li>Sau khi chín, cắt cá thành từng miếng ghép thành hình cá Nàng Hai (cá Thác Lát).</li>
                                                                    </ol>
                                                                </div>
                                                                <!-- <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                                                Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <div class="text-center">
                                            <img src="{{URL::asset('images/smile.png')}}" width="100px" alt="">
                                            <br> <br>
                                            <h4>Sản phẩm đã quá thời hạn hoặc không có!</h4>
                                            <br>
                                            <a href="https://agchain.vn/cananghai/" class="btn btn-info" style="border-radius: 8px;" title="Click vào đây để quay về trang chủ"> <strong> <marquee behavior="slide" direction=""> &nbsp; &nbsp; <i class="fa fa-home"></i> Quay về trang chủ &nbsp; &nbsp; </marquee> </strong> </a>
                                        </div>
                                    @endif
                                @else
                                    @if(isset($noneCode))
                                        <div class="text-center">
                                            <img src="{{URL::asset('images/smile.png')}}" width="100px" alt="">
                                            <br> <br>
                                            <h4> Mã không hợp lệ!</h4>
                                            <br>
                                            <a href="https://agchain.vn/cananghai/" class="btn btn-info" style="border-radius: 8px;" title="Click vào đây để quay về trang chủ"> <strong> <marquee behavior="slide" direction=""> &nbsp; &nbsp; <i class="fa fa-home"></i> Quay về trang chủ &nbsp; &nbsp; </marquee> </strong> </a>
                                        </div>
                                    @else
                                        <div class="text-center">
                                            <img src="{{URL::asset('images/smile.png')}}" width="100px" alt="">
                                            <br> <br>
                                            <h4> Không kết nối được tới hệ thống blockchain!</h4>
                                            <br>
                                            <a href="https://agchain.vn/cananghai/" class="btn btn-info" style="border-radius: 8px;" title="Click vào đây để quay về trang chủ"> <strong> <marquee behavior="slide" direction=""> &nbsp; &nbsp; <i class="fa fa-home"></i> Quay về trang chủ &nbsp; &nbsp; </marquee> </strong> </a>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                    @if(isset($response))
                        @if ($response->getStatusCode()==200)
                            @if($commodity)
                                <div class="col-md-12" style="margin-top: 20px;">
                                    <div class="card">
                                        <div class="card-header" style="background-color:#012A3F !important; color:#A89572; font-weight:bold;"> <i class="fa fa-sun fa-spin"></i> QUY TRÌNH - CHUỖI SẢN PHẨM</div>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-10 col-md-8 col-lg-8 col-xl-6 offset-sm-1 offset-md-2 offset-lg-2 offset-xl-3">
                                                    <ul class="timeline">
                                                        @if($commodity->trace)
                                                            @foreach($commodity->trace as $trace)
                                                                <?php $arrActionAndCompanyName = App\Http\Controllers\ServiceController::ConvertResourceToLabelTimeLine($trace->oldOwner);  ?>
                                                                <li>
                                                                    <span class="badge badge-pill badge-info" style="padding:7px;"> &nbsp;&nbsp; {{ $arrActionAndCompanyName->actionTransaction }} &nbsp;&nbsp; </span>
                                                                    <br> 
                                                                    <div class="text-danger float-left"> <strong> &nbsp;&nbsp; {{ $arrActionAndCompanyName->companyName }} </strong></div>
                                                                    <div class="text-danger float-right"> <strong> {{ date('d/m/Y', strtotime($trace->timestamp)) }} </strong> </div>
                                                                    <br>
                                                                    <p> <br> <strong> Mã has: </strong> <div class="text-primary" style="font-style: italic;"> {{ $trace->transactionId }} </div> </p>
                                                                    <!-- Button trigger modal -->
                                                                    <button type="button" class="badge badge-pill btn btn-success float-right btn-modal" transactionid="{{ $trace->transactionId }}" data-toggle="modal" data-target="#exampleModalLong" style="padding:7px;">
                                                                        &nbsp;&nbsp; Click để xem thông tin trên khối blockchain <i class="fa fa-angle-double-right"></i> &nbsp;&nbsp; 
                                                                    </button>
                                                                    <br>
                                                                </li>
                                                            @endforeach
                                                        @else
                                                            <li>
                                                                <span class="badge badge-pill badge-info" style="padding:7px;"> &nbsp;&nbsp; Sản xuất - Đóng gói &nbsp;&nbsp; </span>
                                                                <br> 
                                                                <div class="text-danger float-left"> <strong> &nbsp;&nbsp; {{ App\Http\Controllers\ServiceController::ConvertResourceToCompanyName($commodity->owner) }} </strong></div>
                                                                <div class="text-danger float-right"> <strong> {{ date('d/m/Y', strtotime($commodity->dateProduct)) }} </strong> </div>
                                                                <br>
                                                            </li>
                                                        @endif


                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endif
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header" style="background-color:#012A3F !important; color:#A89572; font-weight:bold;">
                            <h5 class="modal-title" id="exampleModalLongTitle">Thông tin trên khối blockchain</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div style="font-weight: bold;">
                                Mã hash: <span id="hash-code" class="text-primary"></span>
                            </div>
                            <br>
                            <div id="block-information" style="font-style: italic;">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        </div>
                        </div>
                    </div>
                </div>

            </main>

            <!-- Footer -->
            <div class="footer" style="background-color:#012A3F; color:#ffffff; padding:20px;">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 text-center">
                            <p> CÁ NÀNG HAI THANH TÙNG </p>
                            <p> HỆ THỐNG TRUY XUẤT NGUỒN GỐC </p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 text-center">
                            <img src="{{URL::asset('images/logo_agchain.png')}}" alt="" width="64px;">
                            <img src="{{URL::asset('images/logo_agu.ico')}}" alt="" width="64px;">
                            <img src="{{URL::asset('images/logo_vbc.png')}}" alt="" width="64px;">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-5 text-center">
                            <p> <a target="_blank" class="a-none_underline-color_white" href="https://agchain.vn/"> ĐƯỢC PHÁT TRIỂN BỞI IBLAB - AGU </a> </p>
                            <p> <a target="_blank" class="a-none_underline-color_white" href="http://vietnamblockchain.asia/"> ĐƯỢC TÀI TRỢ BỞI VIỆT NAM BLOCKCHAIN CORPORATION </a> </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
    </body>
    <!-- script -->
    <script src="{{ URL::asset('js/jquery-3.3.1.js') }}"></script>
    <script src="{{ URL::asset('js/popper.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <!-- Data table -->
    <script src="{{ URL::asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- My define -->
    <script src="{{ URL::asset('js/mydefine.js') }}"></script>
    <script>
        $('.btn-modal').click(function(e){
            var transactionid = $(this).attr('transactionid');
            var urlTransaction = "{{route('transaction')}}" + "/" + transactionid;
            console.log(urlTransaction);
            $('#hash-code').html("");
            $('#block-information').html("");
            $.ajax({
                method: "GET",
                url: urlTransaction
            })
            .done(function( msg ) {
                if(msg.statusCode == 200)
                {
                    var str = "{<br>";
                    $.each(msg.body, function(key, value){
                        str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + key + ": " + value + "<br>";
                    });
                    str += "}<br>";
                    $('#hash-code').html(transactionid);
                    $('#block-information').html(str);
                }
                else
                    $('#block-information').html('<h4> Không kết nối được tới hệ thống blockchain </h4>');
            })
            .fail(function( msg ) {
                $('#block-information').html('<h4> Không kết nối được tới hệ thống blockchain </h4>');
            });
        });
    </script>
    @yield('javasript')
</html>
