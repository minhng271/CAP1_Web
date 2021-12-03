@extends('layouts.vaccine')
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
        font-size: 16px;
        font-weight: 600;
        color: #3a47de;
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
                                            <h5 class="card-title">Vắc Xin nhận được<br><br><br></h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <img style="width: 100%;" src="{{ asset('img/icons/add_vaccine.png') }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{number_format($sum_vac)}} <span style=" font-size: 13px; font-weight: 400; text-transform: lowercase; color: black;">
                                        (Liều)
                                    </span></h1>
                                    <div class="mb-0">
                                        <span class="text-muted"> Số liệu từ trước tới nay</span>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="card col-md-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Tiêm thành công<br><span style=" font-size: 13px; font-weight: 400; text-transform: lowercase; color: black;">
                                                (trong Tháng)
                                            </span></h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <img style="width: 100%;" src="{{ asset('img/icons/smile.png') }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <h1 class="mt-1 mb-3">{{number_format($sum_vac_done)}}<span style=" font-size: 13px; font-weight: 400; text-transform: lowercase; color: black;">
                                        (Người đăng ký)
                                    </span></h1>
                                    <div class="mb-0">
                                        <span class="text-muted">Đã Tiêm </span>
                                        <span class="text-success">{{$ratio_sum_vac_done}}%</span>
                                        <span class="text-muted"> đăng ký trong tháng</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card col-md-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Vắc Xin còn lại<br><span style=" font-size: 13px; font-weight: 400; text-transform: lowercase; color: black;">
                                                (trong Tháng)
                                            </span></h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <img style="width: 100%;" src="{{ asset('img/icons/vaccine-con-lai.png') }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <h1 class="mt-1 mb-3">{{number_format($sum_vac_remain) }}<span style=" font-size: 13px; font-weight: 400; text-transform: lowercase; color: black;">
                                        (Liều)
                                    </span></h1>
                                    <div class="mb-0">
                                        <span class="text-muted">Còn lại </span>
                                        <span class="text-success">{{$ratio_sum_vac_remain}}%</span>
                                        <span class="text-muted">Vắc Xin</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card col-md-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Vaccine dùng nhiều nhất<br><span style=" font-size: 13px; font-weight: 400; text-transform: lowercase; color: black;">
                                                (trong Tháng)</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="shopping-cart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{$vac_top['name']}}</h1>
                                    <div class="mb-0">
                                        <h3 class="">{{number_format($vac_top['so_luong'])}}<span style=" font-size: 13px; font-weight: 400; text-transform: lowercase; color: black;">
                                            (Liều)
                                        </span> </h3>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row content-chart mt-4">
                        <div class="col-xl-12 col-xxl-12 col-md-12 ">
                            <div class="card flex-fill w-100">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">BIỂU ĐỒ TỈ LỆ tiêm vác xin THEO THÁNG - NĂM 2021</h5>
                                </div>
                                <div class="card-body py-3">
                                    <div class="chart chart-sm">
                                        <canvas id="chartjs-dashboard-line"></canvas>
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
        var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
        var gradient = ctx.createLinearGradient(0, 0, 0, 225);
        gradient.addColorStop(0, "rgba(215, 227, 244, 0.5)");
        gradient.addColorStop(1, "rgba(215, 227, 244, 0.3)");
        // Line chart
        var data = <?= json_encode($data); ?>;
        new Chart(document.getElementById("chartjs-dashboard-line"), {
            type: "line",
            data: {
                labels: ["Tháng 1","Tháng 2","Tháng 3","Tháng 4","Tháng 5","Tháng 6","Tháng 7","Tháng 8","Tháng 9",
                "Tháng 10","Tháng 11","Tháng 12",
                ],
                datasets: [{
                    label: "Tiêm Thành Công",
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

    });
</script>