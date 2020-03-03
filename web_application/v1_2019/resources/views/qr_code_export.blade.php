<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Export QR CODE</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="{{URL::asset('css/bootstrap.3.3.7.min.css')}}">
        <!-- Latest compiled and minified CSS -->
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
        <!-- Font Awesome -->
        <link href=" {{URL::asset('css/fontawesome/css/all.css')}} " rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #f8f8f8;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            @page {
                header: page-header;
                footer: page-footer;
            }
        </style>
    </head>
    <body>
      <htmlpageheader name="page-header">
        <table width="100%">
          <tbody>
            <tr>
              <td width="70%">HỆ THỐNG ĐƯỢC PHÁT TRIỂN BỞI IBL AGU</td>
              <td width="30%" class="text-right"></td>
            </tr>
          </tbody>
        </table>
      </htmlpageheader>

      


      <?php
        $maxColumn = 8; 
        $maxRow = 11; 

        $numCount = 88;
      ?>

      @if(isset($dsQRCodeBar))
        <table width="100%">
          <tbody id="tbody-qrcodebar-list">
            @foreach($dsQRCodeBar as $qrCodeBar)
              
              @if($numCount % $maxColumn == 1)
                <tr style="margin-bottom: 30px;">
              @endif
              
              <td class="text-center">
                <div class="row">
                  <table>
                    <tbody>
                      <tr>
                        <td class="text-center" style="border-color: blue; border-style: dotted; border-width: 0.1em; background-color: #fff;">
                          <?php $DATA = route('trace', ['code'=>$qrCodeBar->maqr]);?>
                          <img src="https://chart.googleapis.com/chart?cht=qr&chl={{$DATA}}&chs=160x160&chld=L|0" width="65">
                          <div style="font-size: 6pt;">
                            {{$qrCodeBar->stt}}
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div style="font-size: 6pt;">
                  {{$qrCodeBar->stt}}
                </div>
              </td>
              
              @if($numCount % $maxColumn == intval(0))
                </tr>
              @endif
              <?php $numCount++; ?>
            @endforeach

          </tbody>
        </table>
      @endif

        <htmlpagefooter name="page-footer">
            <table width="100%">
            <tbody>
                <tr>
                <td width="45%">HỆ THỐNG ĐƯỢC PHÁT TRIỂN BỞI IBL AGU</td>
                <td width="10%" class="text-center">{PAGENO}</td>
                <td width="45%" class="text-right">WEBSITE: HTTPS://WWW.AGCHAIN.VN</td>
                </tr>
            </tbody>
            </table>
        </htmlpagefooter>
    </body>
</html>