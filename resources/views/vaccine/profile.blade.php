@extends('layouts.vaccine')
@section('content')
    <div class="content">
        <div class="profile">
            <div class="content"  style="background: white; border-radius: 8px">
                @if (session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif
                <div class="profile-main">
                    <div class="profile-top row">
                        <div class="profile-avatar col-md-4 d-flex justify-content-center">
                            <img src="{{ asset('img/avatars/'.$hospital->images) }}" style='width: 300px; height: 300px; border-radius: 100%;' alt="">
    
                        </div>
                        <div class="profile-first col-md-8">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="name">Tên Bệnh Viện</label>
                                    <input class="form-control" type="text" disabled name="name" id="name" value="{{$hospital->name}}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="gmail">Gmail</label>
                                    <input class="form-control" type="text" disabled name="gmail" id="gmail" value="{{$hospital->email}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phone">Số Điện Thoại</label>
                                    <input class="form-control" type="text" disabled name="phone" id="phone" value="{{$hospital->phone}}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="date_add">Ngày Tạo</label>
                                    <input class="form-control" type="text" disabled name="date_add" id="date_add" value="{{date('d-m-Y',strtotime($hospital->created_at))}}">
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="address">Địa Chỉ</label>
                                    <input class="form-control" type="text" disabled name="address" id="address" value="{{$hospital->address}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="name">Tỉnh/ Thành Phố</label>
                                    <input class="form-control" type="text" disabled name="name" id="name" value="{{$hospital->city}}">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="name">Quận/ Huyện</label>
                                    <input class="form-control" type="text" disabled name="name" id="name" value="{{$hospital->province}}">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="gmail">Phường/ Xã</label>
                                    <input class="form-control" type="text" disabled name="gmail" id="gmail" value="{{$hospital->ward}}">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="profile-bot row">
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-8">
                            <a class="mb-3 col-md- btn btn-primary" href="{{ url('vaccine/profile/edit') }}">Chỉnh Sửa Thông Tin</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
