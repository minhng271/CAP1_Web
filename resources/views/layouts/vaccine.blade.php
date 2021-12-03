<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('img/icons/icon-48x48.png') }}" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <title>Admin MTAC</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
</head>

<body>
    <style>
        .card.flex-fill {
            min-height: 425px;
            margin-bottom: 10px;
        }
        
        .d-md-table-cell>a {
            display: block;
        }

        li.sidebar-item a {
            padding: 10px;
            font-size: 1.1em;
            display: block;
            position: relative;
            color: white;
            text-decoration: none;
        }

        .dropdown-toggle:after {
            position: absolute;
            top: 15px;
            right: 15px;
        }

        h1.title {
            text-transform: uppercase;
            font-weight: 600;
        }
        i{
            display: inline-block !important;
            padding-right: 10px !important;
        }
    </style>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{ url('/home') }}">
                    <img src="{{ asset('img/mtac-system.png ') }}" alt="">
                </a>
                <ul class="sidebar-nav">

                    <li class="sidebar-item @php if(session('active') == 'dashboard') echo " active" @endphp">
                        <a class="sidebar-link" href="{{ url('dashboard/vaccine') }}">
                            <i class="fas fa-home"></i> <span @php if(session('active') == 'today') echo " style='color: #fff'" @endphp  class="align-middle">Trang Chủ</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-item @php if(session('active') == 'limit') echo " active" @endphp">
                        <a class="sidebar-link" href="{{ url('vaccine/limit') }}">
                            <i class="fas fa-list"></i> <span class="align-middle">Xét giới hạn mỗi ngày</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="#hospital" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">DANH
                            SÁCH HÔM NAY</a>
                        <ul class="collapse list-unstyled @php if(session('active') == 'today' || session('active') == 'waitList') echo " show" @endphp" id="hospital">
                            <li class="@php if(session('active') == 'today') echo " active-a" @endphp"><a href="{{ url('vaccine/tiem-hom-nay') }}" class="sidebar-dropdown-link">
                                 <span @php if(session('active') == 'today') echo " style='color: #fff'" @endphp  class="align-middle">
                                    <i class="fas fa-syringe"></i> Tiêm Hôm Nay</span></a></li>
                            <li class="@php if(session('active') == 'waitList') echo " active-a" @endphp"><a href="{{ url('vaccine/danh-sach-cho') }}" class="sidebar-dropdown-link">
                                 <span @php if(session('active') == 'waitList') echo " style='color: #fff'" @endphp  class="align-middle">
                                    <i class="fas fa-syringe"></i> Danh Sách Xóa tạm thời</span></a></li>
                            
                        </ul>
                    </li>
                    
                    <li class="sidebar-item">
                        <a href="#calander" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">QUẢN LÝ THEO LỊCH</a>
                        <ul class="collapse list-unstyled @php if(session('active') == 'calander') echo " show" @endphp" id="calander">
                            <li class="@php if(session('active') == 'calander') echo " active-a" @endphp"><a href="{{ url('vaccine/danh-sach-theo-lich') }}" class="sidebar-dropdown-link">
                               <span @php if(session('active') == 'calander') echo " style='color: #fff'" @endphp  class="align-middle">
                                <i class="fas fa-calendar-alt"></i> Danh Sách Theo Lịch</span></a></li>
                            
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#vaccine" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            QUẢN LÝ VẮC XIN
                        </a>
                        <ul class="collapse list-unstyled @php if(session('active') == 'them-moi' || session('active') == 'nhap-them' || session('active') == 'danh-sach-vaccine' || session('active') == 'danh-sach-vaccine-da-xoa') echo " show" @endphp" id="vaccine">
                            <li class="@php if(session('active') == 'them-moi') echo " active-a" @endphp"><a href="{{ url('vaccine/them-moi-vaccine') }}" class="sidebar-dropdown-link">
                                 <span @php if(session('active') == 'them-moi') echo " style='color: #fff'" @endphp  class="align-middle">
                                    <i class="fas fa-list"></i> Thêm mới vắc xin</span></a></li>
                            <li class="@php if(session('active') == 'nhap-them') echo " active-a" @endphp"><a href="{{ url('vaccine/nhap-them-vaccine') }}" class="sidebar-dropdown-link">
                                 <span @php if(session('active') == 'nhap-them') echo " style='color: #fff'" @endphp  class="align-middle">
                                    <i class="fas fa-list"></i> Nhập thêm số lượng vắc xin</span></a></li>
                            <li class="@php if(session('active') == 'danh-sach-vaccine') echo " active-a" @endphp"><a href="{{ url('vaccine/danh-sach-vaccine') }}" class="sidebar-dropdown-link">
                                 <span @php if(session('active') == 'danh-sach-vaccine') echo " style='color: #fff'" @endphp  class="align-middle">
                                    <i class="fas fa-list"></i> Danh Sách Vắc Xin Đã Nhập</span></a></li>
                            <li class="@php if(session('active') == 'danh-sach-vaccine-da-xoa') echo " active-a" @endphp"><a href="{{ url('vaccine/danh-sach-vaccine-da-xoa') }}" class="sidebar-dropdown-link">
                                 <span @php if(session('active') == 'danh-sach-vaccine-da-xoa') echo " style='color: #fff'" @endphp  class="align-middle">
                                    <i class="fas fa-list"></i> Danh Sách Vắc Xin đã xóa</span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="#disease" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            QUẢN LÝ LOẠI BỆNH
                        </a>
                        <ul class="collapse list-unstyled @php if(session('active') == 'them-moi-loai-benh' || session('active') == 'nhap-them-loai-benh' || session('active') == 'danh-sach-loai-benh' || session('active') == 'danh-sach-loai-benh-da-xoa') echo " show" @endphp" id="disease">
                            <li class="@php if(session('active') == 'them-moi-loai-benh') echo " active-a" @endphp"><a href="{{ url('vaccine/them-moi-loai-benh') }}" class="sidebar-dropdown-link">
                                 <span @php if(session('active') == 'them-moi-loai-benh') echo " style='color: #fff'" @endphp  class="align-middle">
                                    <i class="fas fa-list"></i> Thêm mới Loại Bệnh</span></a></li>
                            <li class="@php if(session('active') == 'danh-sach-loai-benh') echo " active-a" @endphp"><a href="{{ url('vaccine/danh-sach-loai-benh') }}" class="sidebar-dropdown-link">
                                 <span @php if(session('active') == 'danh-sach-loai-benh') echo " style='color: #fff'" @endphp  class="align-middle">
                                    <i class="fas fa-list"></i> Danh Sách Loại Bệnh Đã Nhập</span></a></li>
                            <li class="@php if(session('active') == 'danh-sach-loai-benh-da-xoa') echo " active-a" @endphp"><a href="{{ url('vaccine/danh-sach-loai-benh-da-xoa') }}" class="sidebar-dropdown-link">
                                 <span @php if(session('active') == 'danh-sach-loai-benh-da-xoa') echo " style='color: #fff'" @endphp  class="align-middle">
                                    <i class="fas fa-list"></i> Danh Sách Loại Bệnh đã xóa</span></a></li>
                        </ul>
                    </li>
                </ul>


            </div>
        </nav>
        <!-- END SIDEBAR  -->
        <div class="main">

            <main class="main-header">
                <nav class="navbar navbar-expand navbar-light navbar-bg box-shadow-none">
                    <a class="sidebar-toggle js-sidebar-toggle">
                        <i class="hamburger align-self-center"></i>
                    </a>

                    <div class="navbar-collapse collapse">
                        <ul class="navbar-nav navbar-align">

                            <li class="nav-item dropdown">
                                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                    data-bs-toggle="dropdown">
                                    <i class="align-middle" data-feather="settings"></i>
                                </a>

                                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                    data-bs-toggle="dropdown">
                                    <img src="{{ asset('img/avatar-hoan-my.png') }}"
                                        class="avatar img-fluid rounded me-1 border" alt="Charles Hall" /> <span
                                        class="text-dark" style="margin-right:20px ">@php
                                            use App\hospital;
                                            echo hospital::where('id_user', Auth::user()->id)->first()->name;
                                        @endphp</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ url('vaccine/profile') }}"><i class="align-middle me-1"
                                            data-feather="user"></i> Thông Tin Cá Nhân</a>
                                    {{-- <a class="dropdown-item" href="#"><i class="align-middle me-1"
                                            data-feather="pie-chart"></i> Phân Tích</a> --}}
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Đăng Xuất
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>

            </main>

            @yield('content')

        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="js/app.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Pie chart
            new Chart(document.getElementById("chartjs-dashboard-pie"), {
                type: "pie",
                data: {
                    labels: ["Chrome", "Firefox", "IE"],
                    datasets: [{
                        data: [4306, 3801, 1689],
                        backgroundColor: [
                            window.theme.primary,
                            window.theme.warning,
                            window.theme.danger
                        ],
                        borderWidth: 5
                    }]
                },
                options: {
                    responsive: !window.MSInputMethodContext,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 75
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
            var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
            document.getElementById("datetimepicker-dashboard").flatpickr({
                inline: true,
                prevArrow: "<span title=\"Previous month\">&laquo;</span>",
                nextArrow: "<span title=\"Next month\">&raquo;</span>",
                defaultDate: defaultDate
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $.datepicker.setDefaults({
                dateFormat: 'dd-mm-yy'
            });
            $(function() {
                $("#from_date").datepicker();
            });
            $('label.result').click(function() {
                $(this).parents('tr').children('th').children('input[type=checkbox]').attr('checked',
                    'checked');
            });
            $('.d-user').click(function() {
                var data = $(this).attr('data');
                var id = $('#' + data).removeClass('d-none');
            });
            $('.d-user-2').click(function() {
                var data = $(this).attr('data');
                var id = $('#' + data).removeClass('d-none');
            });

            $('.btn-d-none').click(function() {
                var data = $(this).attr('data');
                var id = $('#' + data).addClass('d-none');
            });

        });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="Stylesheet"
        type="text/css" />
</body>

</html>
