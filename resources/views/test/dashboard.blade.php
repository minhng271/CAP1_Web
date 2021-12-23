@extends('layouts.test')
@section('content')
    <style>
        .card.col-md-3 {
            margin: 0px 5px;
            transition: all 0.3s linear;
            box-shadow: 0px 0px 1.5px 0px;
        }

        .card.col-md-3:hover {
            transform: scale(1.03);
            box-shadow: 0px 0px 5px;
        }

        .col-md-12.d-flex {
            transform: translateX(-20px);
        }

        h5.card-title {
            text-transform: uppercase;
            font-size: 17px;
            font-weight: 700;
            color: #3a47de;
        }

        h1.mt-1.mb-3 {
            font-size: 2.5rem;
        }

        .card.flex-fill {
            min-height: 425px;
            margin-bottom: 10px;
            box-shadow: 0px 0px 1.5px 0px;
        }

    </style>
    <div id="mess-limit"
        class="swal-overlay swal-overlay--show-modal @php
    if(!DB::table('limit_update')->where('date',date('Y-m-d',strtotime('+ 2day')))->where('limit_test','0')->first()) echo "
        d-none"; @endphp" tabindex="-1">
        <div class="swal-modal" role="dialog" aria-modal="true" style="margin-top: 7% !important; margin-top: 10px">
            <div class="swal-icon swal-icon--warning">

            </div>
            <div class="swal-title" style="position: relative;">
                <i class="fa-solid fa-exclamation"
                    style="position: absolute; z-index: 999; top: -200%;left: 11px;font-size: 3rem;color: #f8bc89;right: 0;"></i>

                Bạn cần cập nhật giới hạn vắc xin cho những ngày tiếp theo !!!
            </div>
            <div class="swal-text" style="">Chuyển tới phần cập nhật ?</div>
            <div class="swal-footer">
                <div class="swal-button-container">
                    <button id="btn-cancel" class="swal-button swal-button--cancel" tabindex="0">Cancel</button>
                </div>
                <div class="swal-button-container">
                    <a id="btn-redirect-update" href="{{ url('test/limit') }}"
                        class=" text-decoration-none swal-button swal-button--confirm swal-button--danger">OK</a>
                </div>
            </div>
        </div>
    </div>
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-md-12 d-flex">
                    <div class="card col-md-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Tổng số đăng ký xét nghiệm hôm NAY</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <img style="width: 100%;" src="{{ asset('img/icons/c1.jpg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3">{{ $sum_count_now }} <span
                                    style=" font-size: 13px; font-weight: 400; text-transform: lowercase; color: black;">
                                    (Người đăng ký)
                                </span></h1>
                            <div class="mb-0">
                                <span
                                    class="@php if(($ratio_sum_count_now<0)){ echo 'text-danger'; }else echo 'text-success';@endphp">
                                    <i class="mdi mdi-arrow-bottom-right"></i>
                                    @php
                                        if ($ratio_sum_count_now > 0) {
                                            echo '+';
                                        }
                                    @endphp {{ $ratio_sum_count_now }}%</span>
                                <span class="text-muted">So với hôm qua</span>
                            </div>
                        </div>
                    </div>
                    <div class="card col-md-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Tổng số đã xét nghiệm<span
                                            style=" font-size: 13px; font-weight: 400; text-transform: lowercase; color: black;">
                                            (trong tháng)</span></h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <img style="width: 100%;" src="{{ asset('img/icons/c2.jpg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3">{{ $sum_test_done }} <span
                                    style=" font-size: 13px; font-weight: 400; text-transform: lowercase; color: black;">
                                    (Người đăng ký)
                                </span></h1>
                            <div class="mb-0">
                                <span
                                    class="@php if(($ratio_sum_test_done<0)){ echo 'text-danger'; }else echo 'text-success';@endphp">
                                    <i class="mdi mdi-arrow-bottom-right"></i>
                                    @php
                                        if ($ratio_sum_test_done > 0) {
                                            echo '+';
                                        }
                                    @endphp {{ $ratio_sum_test_done }}% </span>
                                <span class="text-muted">So với tháng trước</span>
                            </div>
                        </div>
                    </div>

                    <div class="card col-md-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">
                                        Âm tính <br> <span
                                            style=" font-size: 13px; font-weight: 400; text-transform: lowercase; color: black;">
                                            (trong tháng)
                                        </span></h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary" style="background: rgb(0 255 0 / 42%)">
                                        <img style="width: 100%;" src="{{ asset('img/icons/smile.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3" style="color: rgb(56, 230, 56)">{{ $sum_negative }} <span
                                    style=" font-size: 13px; font-weight: 400; text-transform: lowercase; color: black;">
                                    (Người đăng ký)
                                </span></h1>
                            <div class="mb-0">
                                <span
                                    class="@php if(($ratio_sum_negative<0)){ echo 'text-danger'; }else echo 'text-success';@endphp">
                                    <i class="mdi mdi-arrow-bottom-right"></i>
                                    @php
                                        if ($ratio_sum_negative > 0) {
                                            echo '+';
                                        }
                                    @endphp {{ $ratio_sum_negative }}%</span>
                                <span class="text-muted">So với tháng trước</span>
                            </div>
                        </div>
                    </div>
                    <div class="card col-md-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title"> Dương tính <br><span
                                            style=" font-size: 13px; font-weight: 400; text-transform: lowercase; color: black;">
                                            (trong tháng)
                                        </span></h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <img style="width: 100%" src="{{ asset('img/icons/coronavirus.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3" style="color: red">{{ $sum_positive }} <span
                                    style=" font-size: 13px; font-weight: 400; text-transform: lowercase; color: black;">
                                    (Người đăng ký)
                                </span></h1>
                            <div class="mb-0">
                                <span
                                    class="@php if(($ratio_sum_positive>0)){ echo 'text-danger'; }else echo 'text-success';@endphp">
                                    <i class="mdi mdi-arrow-bottom-right"></i>
                                    @php
                                        if ($ratio_sum_positive > 0) {
                                            echo '+';
                                        }
                                    @endphp {{ $ratio_sum_positive }}%</span>
                                <span class="text-muted">So với tháng trước</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row content-chart mt-4">
                <div class="col-xl-12 col-xxl-12 col-md-12 ">
                    <div class="card flex-fill w-100">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Biểu Đồ tỉ lệ xét nghiệm theo Tháng - năm @php
                                echo date('Y');
                            @endphp</h5>
                        </div>
                        <div class="card-body py-3">
                            <div class="chart chart-sm">
                                <canvas id="chartjs-dashboard-line"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="card flex-fill w-100">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Biểu Đồ tỉ lệ âm tính theo Tháng - năm @php
                                echo date('Y');
                            @endphp</h5>
                        </div>
                        <div class="card-body py-3">
                            <div class="chart chart-sm">
                                <canvas id="chartjs-dashboard-am"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="card flex-fill w-100">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Biểu Đồ tỉ lệ Dương tính theo Tháng - năm @php
                                echo date('Y');
                            @endphp</h5>
                        </div>
                        <div class="card-body py-3">
                            <div class="chart chart-sm">
                                <canvas id="chartjs-dashboard-duong"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
            var gradient = ctx.createLinearGradient(0, 0, 0, 225);
            gradient.addColorStop(0, "rgba(215, 227, 244, 0.5)");
            gradient.addColorStop(1, "rgba(215, 227, 244, 0.3)");
            // Line chart
            var data = <?= json_encode($data) ?>;
            new Chart(document.getElementById("chartjs-dashboard-line"), {
                type: "line",
                data: {
                    labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7",
                        "Tháng 8", "Tháng 9",
                        "Tháng 10", "Tháng 11", "Tháng 12",
                    ],
                    datasets: [{
                        label: "Xét Nghiệm Thành Công",
                        fill: true,
                        backgroundColor: gradient,
                        borderColor: window.theme.primary,
                        data: data
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: true
                    },
                    tooltips: {
                        intersect: false
                    },
                    hover: {
                        intersect: true
                    },
                    plugins: {
                        filler: {
                            propagate: true
                        }
                    },
                    scales: {
                        xAxes: [{
                            reverse: true,
                            gridLines: {
                                color: "rgba(0,0,0,0.0)"
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                stepSize: 1000
                            },
                            display: true,
                            borderDash: [3, 3],
                            gridLines: {
                                color: "rgba(0,0,0,0.0)"
                            }
                        }]
                    }
                }
            });

            var ctx = document.getElementById("chartjs-dashboard-am").getContext("2d");
            var gradient2 = ctx.createLinearGradient(0, 0, 0, 225);
            gradient2.addColorStop(0, "rgba(56, 230, 56, 0.5)");
            gradient2.addColorStop(1, "rgba(56, 230, 56, 0.3)");
            var data2 = <?= json_encode($data2) ?>;
            new Chart(document.getElementById("chartjs-dashboard-am"), {
                type: "line",
                data: {
                    labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7",
                        "Tháng 8", "Tháng 9",
                        "Tháng 10", "Tháng 11", "Tháng 12",
                    ],
                    datasets: [{
                        label: "Âm Tính",
                        fill: true,
                        backgroundColor: gradient2,
                        borderColor: "rgba(56, 230, 56, 1)",
                        data: data2
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: true
                    },
                    tooltips: {
                        intersect: false
                    },
                    hover: {
                        intersect: true
                    },
                    plugins: {
                        filler: {
                            propagate: true
                        }
                    },
                    scales: {
                        xAxes: [{
                            reverse: true,
                            gridLines: {
                                color: "rgba(0,0,0,0.0)"
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                stepSize: 1000
                            },
                            display: true,
                            borderDash: [3, 3],
                            gridLines: {
                                color: "rgba(0,0,0,0.0)"
                            }
                        }]
                    }
                }
            });

            var ctx = document.getElementById("chartjs-dashboard-duong").getContext("2d");
            var gradient3 = ctx.createLinearGradient(0, 0, 0, 225);
            gradient3.addColorStop(0, "rgba(255, 0, 0, 0.5)");
            gradient3.addColorStop(1, "rgba(255, 0, 0, 0.3)");
            var data3 = <?= json_encode($data3) ?>;
            new Chart(document.getElementById("chartjs-dashboard-duong"), {
                type: "line",
                data: {
                    labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7",
                        "Tháng 8", "Tháng 9",
                        "Tháng 10", "Tháng 11", "Tháng 12",
                    ],
                    datasets: [{
                        label: "Dương Tính",
                        fill: true,
                        backgroundColor: gradient3,
                        borderColor: "rgba(255, 0, 0, 1)",
                        data: data3
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: true
                    },
                    tooltips: {
                        intersect: false
                    },
                    hover: {
                        intersect: true
                    },
                    plugins: {
                        filler: {
                            propagate: true
                        }
                    },
                    scales: {
                        xAxes: [{
                            reverse: true,
                            gridLines: {
                                color: "rgba(0,0,0,0.0)"
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                stepSize: 1000
                            },
                            display: true,
                            borderDash: [3, 3],
                            gridLines: {
                                color: "rgba(0,0,0,0.0)"
                            }
                        }]
                    }
                }
            });
        });
    </script>
@endsection
