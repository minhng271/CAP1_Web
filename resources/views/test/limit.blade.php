@extends('layouts.test')
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
    @php

    @endphp
    <div class="content">
        <div class="container-fluid p-0">
            @if (session('limit'))
                <span style="top: -48px;width: 30%;transform: translateX(15px);" class="alert alert-success"><b>{{ session('limit') }}</b></span>
            @endif
            <div class="col-12 col-lg-12 col-xxl-12">
                <div class="card-header  d-flex justify-content-between">
                    <h3>Xét giới hạn người đăng ký trong một ngày làm việc</h3>
                </div>
                <div class="card flex-fill" style=" display: flex; align-items: center; ">

                    <div class="row"
                        style="margin-top:15px;background: aliceblue;padding: 20px ;width: 96%; border-radius:8px;min-height: 395px;">
                        <div class="mb-3 col-md-4 limit-now">
                            <label class="form-label" for="name"
                                style="    text-transform: uppercase;font-size: 1.2rem; font-weight: 600; font-family: inherit; ">
                                Giới hạn đăng ký hôm nay <br> {{ date('d-m-Y') }}</label>
                            <span
                                style=" font-size: 2.5rem; font-weight: 600; margin-left: 5px; display: inline-block; ">{{ $date_now->limit_test }}
                                <span style=" font-size: 1rem; font-weight: 100; "> (người đăng ký)
                                </span>
                            </span>
                        </div>
                        <div class="col-md-8">
                            <div class="col-md-12 mb-5"
                                style=" text-transform: uppercase;font-size: 1.2rem; font-weight: 600; font-family: inherit; ">
                                Xét giới hạn các ngày tiếp theo năm {{ date('Y') }}
                            </div>
                            <div class="row">
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($limits as $item)
                                    @php
                                        $temp = '+' . $i++ . 'day';
                                    @endphp
                                    <div class="mb-3 col-md-3 d-flex flex-column">
                                        <label class="form-label" for="name"
                                            style="    text-transform: uppercase;font-size: 1rem; font-weight: 600; font-family: inherit; ">
                                            {{ date('d/m', strtotime($temp)) }}</label>
                                        <span
                                            style=" font-size: 1.5rem; font-weight: 400; margin-left: 15px; display: inline-block; ">
                                            {{$item->limit_test}}
                                        </span>
                                        <span style=" font-size: 0.8rem; ">
                                            (người đăng ký)
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="row d-flex justify-content-end">
                            <a href="{{ url('test/limit/edit') }}" style="width: 15%;height: 65%;"
                                class="btn btn-primary">Thay đổi giới hạn</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
