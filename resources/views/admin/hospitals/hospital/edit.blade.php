@extends('layouts.admin')
@section('content')
    <style>
        .card-header.font-weight-bold {
            text-transform: uppercase;
            font-size: 1.7rem;
        }

    </style>
    @if (session('status'))
        <span class="alert alert-success">{{session('status')}}</span>        
    @endif
    <div class="content">
        <div id="content" class="container-fluid">
            <div class="card add">
                <div class="card-header font-weight-bold">
                    Chỉnh sửa thông tin Bệnh Viện
                </div>
                <div class="card-body">
                    {!! Form::open(['url' => 'admin/hospital/store/edit', 'method' => 'POST']) !!}
                    
                    <div class="form-group">
                        {!! Form::label('name', 'Tên Bệnh Viện', []) !!}
                        {!! Form::text('name', "$hospital->name", ['class' => 'form-control', 'id' => 'name']) !!}
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            {!! Form::label('city', 'Tỉnh/ Thành Phố', []) !!}
                            <select name="city" id="city" class="form-select select_address">
                                <option value="">Tỉnh/ Thành Phố</option>
                                @foreach ($city as $val)
                                    <option @php
                                        if($hospital->city == $val->name_city) echo 'selected';
                                    @endphp value="{{ $val->matp }}">{{ $val->name_city }}</option>
                                @endforeach
                            </select>
                            @error('city')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('province', 'Quận/ Huyện', []) !!}
                            <select name="province" id="province" class="form-select select_address">
                                <option value="" selected>Chọn Quận/ Huyện</option>
                            
                                @foreach ($province as $val)
                                <option @php
                                    if($hospital->province == $val->name_province) echo 'selected';
                                @endphp value="{{ $val->maqh }}">{{ $val->name_province }}</option>
                            @endforeach

                            </select>
                            @error('province')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('ward', 'Phường/ Xã', []) !!}
                            <select name="ward" id="ward" class="form-select">
                                <option value="">Chọn Phường/ Xã</option>
                                @foreach ($ward as $val)
                                <option @php
                                    if($hospital->ward == $val->name_wards) echo 'selected';
                                @endphp value="{{ $val->xaid }}">{{ $val->name_wards }}</option>
                            @endforeach

                            </select>
                            @error('ward')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('address', 'Địa Chỉ/ Số Nhà', []) !!}
                            <input type="text" name="address" id="address" class="form-control" value="{{$hospital->address}}">
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" name="submit_edit" value="{{$hospital->id}}">Thay Đổi</button>
                    <a href="{{ url('admin/hospital', []) }}" class="btn btn-secondary" >Hủy</a>
    
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
