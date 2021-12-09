<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/style-home.css') }}">
    <title>HOME</title>
</head>

<body>
    <style>
        .Text-before {
            position: absolute;
            background: rgb(46, 38, 38);
            opacity: 0%;
            transition: all 0.4s linear;
            z-index: 2;
        }

        .Test:hover .Text-before {
            opacity: 80%;
            transform: translateX(0%);
        }

        .Test {
            position: relative;
            display: block;
            overflow: hidden;
        }

        .Vaccine:hover .Text-before {
            opacity: 80%;
            transform: translateX(0%);
        }

        .Vaccine {
            position: relative;
            display: block;
            overflow: hidden;
        }

    </style>
    <div class="container">
        <img src="{{ asset('img/mtac-system.png') }}" alt="" />
        <div class="menu">
            <div class="Vaccine">
              @php
              if (Auth::user()->type == 'hospital' && Auth::user()->type_hos == 'test') {
                  echo "<div class='d-flex'>
                                  <div class='Test-before'></div>
                                  <div class='Text-before'
                                      style='color: white;font-family: monospace; font-size: 2rem; display: flex; justify-content: center; align-items: center; top: 0; left: 0; right: 0; bottom: 0; '>
                                      Tài khoản của bạn không được sử dụng chức năng này</div>
                        </div>";
              }
              if (Auth::user()->type_hos == 'null') {
                  echo "<div class='d-flex'>
                                  <div class='Test-before'></div>
                                  <div class='Text-before'
                                      style='color: white;font-family: monospace; font-size: 2rem; display: flex; justify-content: center; align-items: center; top: 0; left: 0; right: 0; bottom: 0; '>
                                      Tài khoản của bạn không được sử dụng chức năng này</div>
                        </div>";
              }
              
          @endphp
            
          <a href="@if (Auth::user()->type == 'hospital' && Auth::user()->type_hos == 'test')
            # 
            @else {{ url('dashboard/vaccine') }} @endif">
                    <img src="{{ asset('img/iconVac.png') }}" alt="" /> <br />
                    <span>Tiêm Vaccine</span>
                </a>
            </div>
            
            <div class="Test">
                @php
                    if (Auth::user()->type == 'hospital' && Auth::user()->type_hos == 'vaccine') {
                        echo "<div class='d-flex'>
                                        <div class='Test-before'></div>
                                        <div class='Text-before'
                                            style='color: white;font-family: monospace; font-size: 2rem; display: flex; justify-content: center; align-items: center; top: 0; left: 0; right: 0; bottom: 0; '>
                                            Tài khoản của bạn không được sử dụng chức năng này</div>
                              </div>";
                    }
                    
                    if (Auth::user()->type_hos == 'null') {
                        echo "<div class='d-flex'>
                                        <div class='Test-before'></div>
                                        <div class='Text-before'
                                            style='color: white;font-family: monospace; font-size: 2rem; display: flex; justify-content: center; align-items: center; top: 0; left: 0; right: 0; bottom: 0; '>
                                            Tài khoản của bạn không được sử dụng chức năng này</div>
                              </div>";
                    }
                    
                @endphp


                <a href="@if (Auth::user()->type == 'hospital' && Auth::user()->type_hos == 'vaccine')
                    # 
                    @else {{ url('dashboard/test') }} @endif">
                    <img src="{{ asset('img/iconTest.png') }}" alt="" /> <br />
                    <span>Xét nghiệm</span>
                </a>
            </div>
        </div>
    </div>

</body>

</html>
