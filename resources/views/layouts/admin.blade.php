<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('img/icons/icon-48x48.png') }}" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <title>Hệ Thống MTAC</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
</head>

<body>
    <style>
        body{
            font-family: Nunito;
        }
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

        .card.position-relative {
            top: 25px;
        }
        ul>li>a>span{
            text-transform: capitalize;
        }
        li.sidebar-item>a {margin-left: 10px;}
        

    </style>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{ url('dashboard/admin') }}">
                    <img src="{{ asset('img/mtac-system.png ') }}" alt="">
                </a>
                <ul class="sidebar-nav">
                    <li class="sidebar-header" style="font-size: 20px">
                        ACCOUNT-ADMIN
                    </li>
                    <li></li>
                    <li class="sidebar-item">
                        <a href="#hospital" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">DANH
                            SÁCH BỆNH VIỆN</a>
                        <ul class="collapse list-unstyled @php if(session('active') == 'hos_add1' || session('active') == 'hos_lis1' ||session('active') == 'hos_bin1') echo "
                            show" @endphp" id="hospital">
                            <li class="@php if(session('active') == 'hos_add1') echo " active-a" @endphp"><a
                                    href="{{ url('admin/hospital/add') }}" class="sidebar-dropdown-link">Thêm Bệnh
                                    Viện</a></li>
                            <li class="@php if(session('active') == 'hos_lis1') echo " active-a" @endphp"><a
                                    href="{{ url('admin/hospital') }}" class="sidebar-dropdown-link">Danh Sách Bệnh
                                    Viện</a></li>
                            <li class="@php if(session('active') == 'hos_bin1') echo " active-a" @endphp"><a
                                    href="{{ url('admin/hospital/bin') }}" class="sidebar-dropdown-link">Danh Sách
                                    Đã Xóa</a></li>
                        </ul>
                    </li>
                    <li></li>
                    <li class="sidebar-item">
                        <a href="#hospital_account" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">TÀI KHOẢN BỆNH VIỆN</a>
                        <ul class="collapse list-unstyled @php if(session('active') == 'hos_add' || session('active') == 'hos_lis' ||session('active') == 'hos_bin') echo "
                            show" @endphp" id="hospital_account">
                            <li class="@php if(session('active') == 'hos_add') echo " active-a" @endphp"><a
                                    href="{{ url('admin/hospital-acc/add') }}" class="sidebar-dropdown-link">Thêm Tài
                                    Khoản Bệnh Viện</a></li>
                            <li class="@php if(session('active') == 'hos_lis') echo " active-a" @endphp"><a
                                    href="{{ url('admin/hospital-acc') }}" class="sidebar-dropdown-link">Danh Sách Tài
                                    Khoản</a></li>
                            <li class="@php if(session('active') == 'hos_bin') echo " active-a" @endphp"><a
                                    href="{{ url('admin/hospital-acc/bin') }}" class="sidebar-dropdown-link">Tài Khoản Đã Xóa</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#user" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">DANH SÁCH
                            NGƯỜI DÙNG</a>
                        <ul class="collapse list-unstyled @php if(session('active') == 'user_add' || session('active') == 'user_list' ||session('active') == 'user_bin') echo "
                            show" @endphp" id="user">
                            <li class="@php if(session('active') == 'user_add') echo " active-a" @endphp"><a
                                    href="{{ url('admin/user/add') }}" class="sidebar-dropdown-link">Thêm Người
                                    Dùng</a></li>
                            <li class="@php if(session('active') == 'user_list') echo " active-a" @endphp"><a
                                    href="{{ url('admin/users') }}" class="sidebar-dropdown-link">Danh Sách Người
                                    Dùng</a></li>
                            <li class="@php if(session('active') == 'user_bin') echo " active-a" @endphp"><a
                                    href="{{ url('admin/user/bin') }}" class="sidebar-dropdown-link">Danh Sách Đã Xóa</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#backup" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Quản Lý
                            DATA</a>
                        <ul class="collapse list-unstyled @php if(session('active') == 'backup' || session('active') == 'restore_data') echo "
                            show" @endphp" id="backup">
                            <li class="@php if(session('active') == 'backup') echo " active-a" @endphp"><a
                                    href="{{ url('admin/data/backup') }}" class="sidebar-dropdown-link">
                                    Sao Lưu Data</a></li>
                            {{-- <li class="@php if(session('active') == 'restore_data') echo " active-a" @endphp"><a
                                    href="{{ url('admin/data/restore') }}" class="sidebar-dropdown-link">
                                    Khôi Phục Data</a></li> --}}
                        </ul>
                    </li>
                    {{-- <li class="sidebar-item @php if(session('active') == 'wait') echo " active-a" @endphp">
                        <a class="sidebar-link" href="{{ url('test/danh-sach-cho') }}">
                            <i class="fas fa-list"></i> <span class="align-middle">Danh Sách Chờ</span>
                        </a>
                    </li> --}}

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
                                    <img src="{{ asset('img/avatar-admin.png') }}"
                                        class="avatar img-fluid rounded me-1 border" alt="Charles Hall" /> <span
                                        class="text-dark" style="margin-right: 20px;">ADMIN</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
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
    
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/app.js') }}"></script>

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

    <script>
        $(document).ready(function() {
            $('li.active-a').parents('li.sidebar-item').children('a.dropdown-toggle').css('backgroundColor','#435ebe54');
            $('label.result').click(function() {
                $(this).parents('tr').children('th').children('input[type=checkbox]').attr('checked',
                    'checked');
            });
            $('.d-user').click(function() {
                var data = $(this).attr('data');
                var id = $('#' + data).removeClass('d-none');
            });
            $('.btn-d-none').click(function() {
                var data = $(this).attr('data');
                var id = $('#' + data).addClass('d-none');
            });
            $("#selectAll").click(function() {
                $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
    
            });

            $('.select_address').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var result = '';

                if(action == 'city'){
                    result = 'province';
                }else {
                    result = 'ward';
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: '{{url('/select-delivery')}}',
                    crossDomain: true,
                    data:{action:action, ma_id:ma_id},
                    success: function (data) { 
                        $('#'+result).html(data);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });
        });
    </script> 
</body>

</html>
