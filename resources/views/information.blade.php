<!DOCTYPE html>
<html style="font-size: 16px;">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Thông tin bệnh nhân​">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/nicepage.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('css/Home.css') }}" media="screen">
    <script class="u-script" type="text/javascript" src="{{ asset('js/jquery.js') }}" defer=""></script>
    <script class="u-script" type="text/javascript" src="{{ asset('js/nicepage.js') }}" defer=""></script>
    <meta name="generator" content="Nicepage 4.9.5, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Home">
    <meta property="og:type" content="website">
</head>

<body class="u-body u-xl-mode">
    <style>
        input {
            color: #f31b1b !important;
        }

    </style>
    <section class="u-clearfix u-section-1" id="carousel_39bf">
        <div class="u-clearfix u-sheet u-valign-middle-sm u-sheet-1">
            <div class="u-palette-1-light-2 u-shape u-shape-rectangle u-shape-1"></div>
            <img src="{{ asset('img/aa49e5bbcb321c65e1d4ba4d4afa599b.png') }}" alt=""
                class="u-image u-image-default u-opacity u-opacity-55 u-image-1" data-image-width="817"
                data-image-height="799">
            <img src="{{ asset('img/hhh1.jpg') }}" alt="" class="u-image u-image-default u-image-2"
                data-image-width="1200" data-image-height="800">
            <div class="u-align-center u-container-style u-group u-white u-group-1">
                <div class="u-container-layout u-valign-top u-container-layout-1">
                    <h1 class="u-custom-font u-font-pt-sans u-text u-text-1">Thông tin bệnh nhân </h1>
                    <div class="u-align-left u-expanded-width-xs u-form u-form-1">
                        <form action="#" method="POST" class="u-clearfix u-form-spacing-28 u-form-vertical u-inner-form"
                            style="padding: 10px" source="email" name="form">
                            <div class="d-flex w-100">
                                <div class="u-form-group u-form-name u-form-group-1">
                                    <label for="name-5a14" class=" u-label" wfd-invisible="true">Họ và Tên</label>
                                    <input type="text" placeholder="Enter your Name" id="name-5a14" name="name"
                                        value="{{ $patient->fullname }}"
                                        class="u-border-2 u-border-black u-border-no-left u-border-no-right u-border-no-top u-input u-input-rectangle u-white"
                                        required="" disabled>
                                </div>

                                <div class="u-form-email u-form-group u-form-group-2">
                                    <label for="email-5a14" class=" u-label" wfd-invisible="true">Email</label>
                                    <input type="text" placeholder="Email" id="email-5a14" name="email"
                                        value="{{ $patient->email }}"
                                        class="u-border-2 u-border-black u-border-no-left u-border-no-right u-border-no-top u-input u-input-rectangle u-white"
                                        required="" disabled>
                                </div>
                            </div>
                            <div class="d-flex w-100">
                                <div class="u-form-email u-form-group u-form-group-2">
                                    <label for="CMND-5a14" class=" u-label" wfd-invisible="true">CMND/CCCD</label>
                                    <input type="text" placeholder="CMND" id="CMND-5a14" name="CMND"
                                        value="{{ $patient->id_card }}"
                                        class="u-border-2 u-border-black u-border-no-left u-border-no-right u-border-no-top u-input u-input-rectangle u-white"
                                        required="" disabled>
                                </div>
                                <div class="u-form-group u-form-name u-form-group-1">
                                    <label for="BHYT-5a14" class=" u-label" wfd-invisible="true">Thẻ BHYT</label>
                                    <input type="text" placeholder="Enter your Name" id="BHYT-5a14" name="BHYT"
                                        value="{{ $patient->health_card }}"
                                        class="u-border-2 u-border-black u-border-no-left u-border-no-right u-border-no-top u-input u-input-rectangle u-white"
                                        required="" disabled>
                                </div>
                            </div>
                            <div class="d-flex w-100">
                                <div class="u-form-email u-form-group u-form-group-2">
                                    <label for="birthday-5a14" class=" u-label" wfd-invisible="true">Ngày
                                        Sinh</label>
                                    <input type="text" placeholder="Ngày Sinh" id="birthday-5a14" name="birthday" value="@php
                                        echo date('d-m-Y', strtotime($patient->birthDate));
                                    @endphp"
                                        class="u-border-2 u-border-black u-border-no-left u-border-no-right u-border-no-top u-input u-input-rectangle u-white"
                                        required="" disabled>
                                </div>
                                <div class="u-form-group u-form-name u-form-group-1">
                                    <label for="GT-5a14" class=" u-label" wfd-invisible="true">Giới Tính</label>
                                    <input type="text" placeholder="Giới Tính" id="GT-5a14" name="GT"
                                        value="@php
                                            if ($patient->gender == 'male') {
                                                echo 'Nam';
                                            } else {
                                                echo 'Nữ';
                                            }
                                        @endphp"
                                        class="u-border-2 u-border-black u-border-no-left u-border-no-right u-border-no-top u-input u-input-rectangle u-white"
                                        required="" disabled>
                                </div>
                                <div class="u-form-email u-form-group u-form-group-2">
                                    <label for="SDT-5a14" class=" u-label" wfd-invisible="true">Số Điện
                                        thoại</label>
                                    <input type="text" placeholder="SDT" id="SDT-5a14" name="SDT"
                                        value="{{ $patient->phone }}"
                                        class="u-border-2 u-border-black u-border-no-left u-border-no-right u-border-no-top u-input u-input-rectangle u-white"
                                        required="" disabled>
                                </div>
                            </div>
                            <div class="d-flex w-100">
                                <div class="u-form-group u-form-name u-form-group-1">
                                    <label for="CV-5a14" class=" u-label" wfd-invisible="true">Công Việc</label>
                                    <input type="text" placeholder="Công việc" id="CV-5a14" name="CV"
                                        value="{{ $patient->job }}"
                                        class="u-border-2 u-border-black u-border-no-left u-border-no-right u-border-no-top u-input u-input-rectangle u-white"
                                        required="" disabled>
                                </div>
                                <div class="u-form-email u-form-group u-form-group-2">
                                    <label for="DT-5a14" class=" u-label" wfd-invisible="true">Dân Tộc</label>
                                    <input type="text" placeholder="Dân Tộc" id="DT-5a14" name="DT"
                                        value="{{ $patient->nation }}"
                                        class="u-border-2 u-border-black u-border-no-left u-border-no-right u-border-no-top u-input u-input-rectangle u-white"
                                        required="" disabled>
                                </div>
                            </div>
                            <div class="d-flex w-100">
                                <div class="u-form-group u-form-name u-form-group-1">
                                    <label for="CV-5a14" class=" u-label" wfd-invisible="true">Địa Chỉ</label>
                                    <input type="text" placeholder="Công việc" id="CV-5a14" name="CV"
                                        value="{{ $patient->address }}"
                                        class="u-border-2 u-border-black u-border-no-left u-border-no-right u-border-no-top u-input u-input-rectangle u-white"
                                        required="" disabled>
                                </div>
                            </div>
                            <div class="d-flex w-100">
                                <div class="u-form-group u-form-name u-form-group-1">
                                    <label for="CV-5a14" class=" u-label" wfd-invisible="true">Xã/ Phường</label>
                                    <input type="text" placeholder="Công việc" id="CV-5a14" name="CV"
                                        value="{{ $patient->ward }}"
                                        class="u-border-2 u-border-black u-border-no-left u-border-no-right u-border-no-top u-input u-input-rectangle u-white"
                                        required="" disabled>
                                </div>
                                <div class="u-form-group u-form-name u-form-group-1">
                                    <label for="CV-5a14" class=" u-label" wfd-invisible="true">Quận/ Huyện</label>
                                    <input type="text" placeholder="Công việc" id="CV-5a14" name="CV"
                                        value="{{ $patient->district }}"
                                        class="u-border-2 u-border-black u-border-no-left u-border-no-right u-border-no-top u-input u-input-rectangle u-white"
                                        required="" disabled>
                                </div>
                                <div class="u-form-group u-form-name u-form-group-1">
                                    <label for="CV-5a14" class=" u-label" wfd-invisible="true">Tỉnh/Thành
                                        Phố</label>
                                    <input type="text" placeholder="Công việc" id="CV-5a14" name="CV"
                                        value="{{ $patient->city }}"
                                        class="u-border-2 u-border-black u-border-no-left u-border-no-right u-border-no-top u-input u-input-rectangle u-white"
                                        required="" disabled>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
