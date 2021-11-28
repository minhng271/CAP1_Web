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
                                <h5 class="card-title">Tổng số xét nghiệm hôm qua</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <img style="width: 100%;" src="{{ asset('img/icons/c1.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">nội dung 1</h1>
                        <div class="mb-0">
                            <span class="@php if((1<0)){ echo 'text-danger'; }else echo 'text-success';@endphp">
                            <i class="mdi mdi-arrow-bottom-right"></i>
                                @php if((2>0)){ echo '+'; } @endphp 10%</span>
                            <span class="text-muted">So với ngày trước</span>
                        </div>
                    </div>
                </div>
                <div class="card col-md-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Tổng số xét nghiệm hôm qua</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <img style="width: 100%;" src="{{ asset('img/icons/c1.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">nội dung 1</h1>
                        <div class="mb-0">
                            <span class="@php if((1<0)){ echo 'text-danger'; }else echo 'text-success';@endphp">
                            <i class="mdi mdi-arrow-bottom-right"></i>
                                @php if((2>0)){ echo '+'; } @endphp 10%</span>
                            <span class="text-muted">So với ngày trước</span>
                        </div>
                    </div>
                </div>
                <div class="card col-md-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Tổng số xét nghiệm hôm qua</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <img style="width: 100%;" src="{{ asset('img/icons/c1.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">nội dung 1</h1>
                        <div class="mb-0">
                            <span class="@php if((1<0)){ echo 'text-danger'; }else echo 'text-success';@endphp">
                            <i class="mdi mdi-arrow-bottom-right"></i>
                                @php if((2>0)){ echo '+'; } @endphp 10%</span>
                            <span class="text-muted">So với ngày trước</span>
                        </div>
                    </div>
                </div>
                <div class="card col-md-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Tổng số xét nghiệm hôm qua</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <img style="width: 100%;" src="{{ asset('img/icons/c1.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">nội dung 1</h1>
                        <div class="mb-0">
                            <span class="@php if((1<0)){ echo 'text-danger'; }else echo 'text-success';@endphp">
                            <i class="mdi mdi-arrow-bottom-right"></i>
                                @php if((2>0)){ echo '+'; } @endphp 10%</span>
                            <span class="text-muted">So với ngày trước</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row content-chart mt-4">
            <div class="col-xl-12 col-xxl-12 col-md-12 ">
                <div class="card flex-fill w-100">
                    <div class="card-header">

                        <h5 class="card-title mb-0">Biểu Đồ tỉ lệ xét nghiệm theo ngày</h5>
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