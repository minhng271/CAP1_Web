@extends('layouts.test')
@section('content')
    <div class="profile">
        <div class="content">
            <form action="{{ url('test/profile/store-edit') }}" method="POST" enctype="multipart/form-data">
                @csrf        
            <div class="profile-main">
                <div class="profile-top row">
                    <div class="profile-avatar col-md-4 d-flex justify-content-center">
                        <img src="{{ asset('img/avatars/'.$hospital->images) }}" style='width: 64%;border-radius: 100%;' alt="">
                        <input class="mt-3" type="file" name="image" id="">
                    </div>
                    <div class="profile-first col-md-8">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="name">Tên Bệnh Viện</label>
                                <input class="form-control" type="text"  name="name" id="name" value="{{$hospital->name}}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="gmail">Gmail</label>
                                <input class="form-control" type="text" disabled name="gmail" id="gmail" value="{{$hospital->email}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phone">Số Điện Thoại</label>
                                <input class="form-control" type="text"  name="phone" id="phone" value="{{$hospital->phone}}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="date_add">Ngày Tạo</label>
                                <input class="form-control" type="text" disabled name="date_add" id="date_add" value="{{date('d-m-Y',strtotime($hospital->created_at))}}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label" for="address">Địa Chỉ</label>
                                <input class="form-control" type="text"  name="address" id="address" value="{{$hospital->address}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                {!! Form::label('city', 'Tỉnh/ Thành Phố', []) !!}
                                <select name="city" id="city" class="form-select select_address">
                                    <option value="">Tỉnh/ Thành Phố</option>
                                    @foreach ($city as $val)
                                        <option value="{{ $val->matp }}">{{ $val->name_city }}</option>
                                    @endforeach
                                </select>
                                @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group">
                                {!! Form::label('province', 'Quận/ Huyện', []) !!}
                                <select name="province" id="province" class="form-select select_address">
                                    <option value="" selected>Chọn Quận/ Huyện</option>
                                </select>
                                @error('province')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group">
                                {!! Form::label('ward', 'Phường/ Xã', []) !!}
                                <select name="ward" id="ward" class="form-select">
                                    <option value="" selected>Chọn Phường/ Xã</option>
                                </select>
                                @error('ward')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="profile-bot row">
                    <div class="col-md-4">
                        
                    </div>
                    <div class="col-md-8">
                        <button class="mb-3 col-md- btn btn-primary" type="submit" name="submit" value="submit">Lưu Thay Đổi</button>
                        <a class="mb-3 col-md- btn btn-outline-secondary" href="{{ url('test/profile') }}">Hủy bỏ</a>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
@endsection
