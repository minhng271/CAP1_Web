@extends('layouts.vaccine')
@section('content')

    <style>
        .limit-top {
            position: relative;
        }

        .limit-top::before {
            position: absolute;
            content: "";
            background: #f5f7fb;
            top: -30px;
            bottom: -31px;
            right: 141px;
            left: 140px;
            border-radius: 8px;
        }

    </style>
    <div class="content">
        @if (session('limit'))
                <div style="margin-bottom: 1px" class="alert alert-success"><b>{{ session('limit') }}</b></div>
        @endif
        <div class="container-fluid p-0">
           <div class="row">
            <div class="col-12 col-lg-12 col-xxl-12">
                <div class="card-header  d-flex justify-content-between">
                    <h3>Xét giới hạn người đăng ký trong một ngày làm việc</h3>
                </div>
                <div class="card flex-fill" style=" display: flex; justify-content: center; align-items: center; ">
                    <div class="limit-top row " style=" justify-content: center; align-items: center; ">
                        <div class="limit-avatar col-md-4 d-flex justify-content-center">
                            <img src="{{ asset('img/avatar.jpg') }}" style='width: 64%;border-radius: 100%;' alt="">

                        </div>
                        <div class="limit col-md-4">
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="name"
                                        style="    text-transform: uppercase;font-size: 1.3rem; font-weight: 600; font-family: inherit; ">
                                        Giới hạn đăng ký tiêm vắc xin COVID-19 hôm nay</label>
                                    <span style=" font-size: 3rem; font-weight: 600; margin-left: 15px; display: inline-block; ">
                                        {{$limit}} <span style=" font-size: 1rem; font-weight: 100; "> (người đăng ký) </span>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <a class="mb-3 col-md- btn btn-outline-primary" href="{{ url('vaccine/limit/edit') }}">
                                        Thay Đổi Giới Hạn</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>     
        </div>


    </div>
@endsection
