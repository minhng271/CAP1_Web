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
        <div class="container-fluid p-0">
           
            <div class="col-12 col-lg-12 col-xxl-12">
                <div class="card-header  d-flex justify-content-between">
                    <h3>Xét giới hạn người đăng ký trong một ngày làm việc</h3>
                </div>
                
                <div class="card flex-fill" style=" display: flex; justify-content: center; align-items: center; ">
                    <div class="limit-top row " style=" justify-content: center; align-items: center; ">
                        <div class="limit-avatar col-md-4 d-flex justify-content-center">
                            <img src="{{ asset('img/avatar.jpg') }}" style='width: 64%;border-radius: 100%;' alt="">

                        </div>
                        <form method="POST" class="limit col-md-4" action="{{ url('vaccine/limit/store_edit') }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="name"
                                        style="    text-transform: uppercase;font-size: 1.3rem; font-weight: 600; font-family: inherit; ">
                                        Giới hạn đăng ký hôm nay</label>
                                    <input type="text" style=" width: 57%; font-size: 2rem; " name="limit" value="{{$limit}}"  >
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="mb-3 mr-3">
                                    <button class="mb-3 col-md- btn btn-primary" type="submit" name="submit" value="submit">Lưu Thay Đổi</button>
                                </div>
                                <div class="mb-3">
                                    <a class="mb-3 col-md- btn btn-outline-secondary" href="{{ url('vaccine/limit') }}">Hủy bỏ</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>


    </div>
@endsection
