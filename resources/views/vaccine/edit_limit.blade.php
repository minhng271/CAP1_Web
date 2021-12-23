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
        <form method="POST" action="{{ url('vaccine/limit/store_edit') }}">
            @csrf
            <div class="container-fluid p-0">
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
                                    Giới hạn đăng ký hôm nay <br> {{ date('d-m-Y') }}{{ date('d') }}</label>
                                <input type="text" name="limit_now" class="form-control"
                                    value="{{ $date_now->limit_vaccine }}"
                                    style=" font-size: 2.5rem; font-weight: 600; display: inline-block; width:50%">

                                <span style=" font-size: 1rem; font-weight: 100; "> (người đăng ký)
                                </span>
                                </span>
                            </div>
                            <div class="col-md-8">
                                <div class="col-md-12 mb-5"
                                    style=" text-transform: uppercase;font-size: 1.2rem; font-weight: 600; font-family: inherit; ">
                                    Xét giới hạn các ngày tiếp theo. tháng {{ date('m') }} năm {{ date('Y') }}
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
                                                style="text-transform: uppercase;font-size: 1rem; font-weight: 600; font-family: inherit; ">
                                                {{ date('d', strtotime($temp)) }}</label>
                                            <input type="text" name="{{ $i }}" value="{{ $item->limit_vaccine }}"
                                                class="form-control">
                                            <span style=" font-size: 0.8rem; ">
                                                (người đăng ký)
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row d-flex justify-content-end">
                                <button class=" col-md- btn btn-primary" style="width: 15%;height: 65%;" type="submit"
                                    name="submit" value="submit">Lưu
                                    Thay Đổi</button>
                                <a class=" col-md- btn btn-outline-secondary" href="{{ url('vaccine/limit') }} "
                                    style="width: 15%; height: 65%;margin-left: 15px;">
                                    Hủy bỏ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>
@endsection
