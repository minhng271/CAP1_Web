@extends('layouts.admin')
@section('content')
<style>
    .card.col-md-3 {
        margin: 0px 5px;
        transition: all 0.3s linear;
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
        font-weight: 600;
        color: #3a47de;
    }

    h1.mt-1.mb-3 {
        font-size: 2.5rem;
    }

</style>
<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-12 d-flex">
                <div class="card col-md-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Tổng số Bệnh viện ĐĂNG KÝ</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <img style="width: 100%;" src="{{ asset('img/icons/c1.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{$sum_count_hos_moth}}</h1>
                        {{-- <div class="mb-0">
                            <span class="@php if((1<0)){ echo 'text-danger'; }else echo 'text-success';@endphp">
                            <i class="mdi mdi-arrow-bottom-right"></i>
                                @php if((2>0)){ echo '+'; } @endphp 10%</span>
                            <span class="text-muted">So với ngày trước</span>
                        </div> --}}
                    </div>
                </div>
                <div class="card col-md-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Bệnh Viện đăng ký <br><span style=" font-size: 13px; font-weight: 400; text-transform: lowercase; color: black;">
                                    (trong tháng)</span></h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <img style="width: 100%;" src="{{ asset('img/icons/c1.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{$sum_hos_moth}}</h1>
                        <div class="mb-0">
                            <span class="@php if(($ratio_sum_hos_moth<0)){ echo 'text-danger'; }else echo 'text-success';@endphp">
                            <i class="mdi mdi-arrow-bottom-right"></i>
                                @php if(($ratio_sum_hos_moth>0)){ echo '+'; } @endphp {{$ratio_sum_hos_moth}}</span>
                            <span class="text-muted">So với tháng trước</span>
                        </div>
                    </div>
                </div>
                <div class="card col-md-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Tổng số Người dùng ĐĂNG KÝ <br></h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <img style="width: 100%;" src="{{ asset('img/icons/c1.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{$sum_count_user_moth}}</h1>
                        {{-- <div class="mb-0">
                            <span class="@php if((1<0)){ echo 'text-danger'; }else echo 'text-success';@endphp">
                            <i class="mdi mdi-arrow-bottom-right"></i>
                                @php if((2>0)){ echo '+'; } @endphp {{$ratio_sum_hos_moth}}</span>
                            <span class="text-muted">So với tháng trước</span>
                        </div> --}}
                    </div>
                </div>
                <div class="card col-md-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Người dùng đăng ký <br><span style=" font-size: 13px; font-weight: 400; text-transform: lowercase; color: black;">
                                    (trong tháng)</span></h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <img style="width: 100%;" src="{{ asset('img/icons/c1.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{$sum_user_moth}}</h1>
                        <div class="mb-0">
                            <span class="@php if((1<0)){ echo 'text-danger'; }else echo 'text-success';@endphp">
                            <i class="mdi mdi-arrow-bottom-right"></i>
                                @php if((2>0)){ echo '+'; } @endphp {{$ratio_sum_user_moth}}</span>
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

                        <h5 class="card-title mb-0">Biểu Đồ tỉ lệ Bệnh viện đăng ký theo tháng - năm {{date('Y')}}</h5>
                    </div>
                    <div class="card-body py-3">
                        <div class="chart chart-sm mt-3">
                            <canvas id="chartjs-dashboard-hos"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row content-chart mt-4">
            <div class="col-xl-12 col-xxl-12 col-md-12 ">
                <div class="card flex-fill w-100">
                    <div class="card-header">

                        <h5 class="card-title mb-0">Biểu Đồ tỉ lệ Ngươi dùng đăng ký theo tháng - năm {{date('Y')}}</h5>
                    </div>
                    <div class="card-body py-3">
                        <div class="chart chart-sm mt-3">
                            <canvas id="chartjs-dashboard-pat"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection



<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById("chartjs-dashboard-hos").getContext("2d");
        var gradient = ctx.createLinearGradient(0, 0, 0, 225);
        gradient.addColorStop(0, "rgba(215, 227, 244, 0.8)");
        gradient.addColorStop(1, "rgba(215, 227, 244, 0.3)");
        var data_hos = <?= json_encode($data_hos) ?>;
        // Line chart
        new Chart(document.getElementById("chartjs-dashboard-hos"), {
            type: "line",
            data: {
                labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7",
                    "Tháng 8", "Tháng 9",
                    "Tháng 10", "Tháng 11", "Tháng 12",
                ],
                datasets: [{
                    label: "Bệnh Viện Đăng Ký",
                    fill: true,
                    backgroundColor: gradient,
                    borderColor: window.theme.primary,
                    data: data_hos
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
                        propagate: false
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

        var ctx = document.getElementById("chartjs-dashboard-pat").getContext("2d");
        var gradient = ctx.createLinearGradient(0, 0, 0, 225);
        gradient.addColorStop(0, "rgba(215, 227, 244, 0.8)");
        gradient.addColorStop(1, "rgba(215, 227, 244, 0.3)");
        var data_pat = <?= json_encode($data_pat) ?>;
        // Line chart
        new Chart(document.getElementById("chartjs-dashboard-pat"), {
            type: "line",
            data: {
                labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7",
                    "Tháng 8", "Tháng 9",
                    "Tháng 10", "Tháng 11", "Tháng 12",
                ],
                datasets: [{
                    label: "Người Dùng Đăng Ký",
                    fill: true,
                    backgroundColor: gradient,
                    borderColor: window.theme.primary,
                    data: data_pat
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
                        propagate: false
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