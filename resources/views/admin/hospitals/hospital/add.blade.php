@extends('layouts.admin')
@section('content')
    <style>
        .card-header.font-weight-bold {
            text-transform: uppercase;
            font-size: 1.7rem;
        }

    </style>
    <div class="content">
        <div id="content" class="container-fluid">
            <div class="card add">
                <div class="card-header font-weight-bold">
                    Thêm MỚI Bệnh Viện
                </div>
                <div class="card-body">
                    {!! Form::open(['url' => 'admin/hospital/store', 'method' => 'POST']) !!}
                    {!! Form::hidden('type', 'hospital', []) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Tên Bệnh Viện', []) !!}
                        {!! Form::text('name', '', ['class' => 'form-control', 'id' => 'name']) !!}
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            {!! Form::label('city', 'Tỉnh/ Thành Phố', []) !!}
                            <select name="city" id="city" class="form-select select_address">
                                <option value="" selected>Tỉnh/ Thành Phố</option>
                                @foreach ($city as $val)
                                    <option value="{{ $val->matp }}">{{ $val->name_city }}</option>
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
                            </select>
                            @error('province')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('ward', 'Phường/ Xã', []) !!}
                            <select name="ward" id="ward" class="form-select">
                                <option value="" selected>Chọn Phường/ Xã</option>
                            </select>
                            @error('ward')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('address', 'Địa Chỉ/ Số Nhà', []) !!}
                            <input type="text" name="address" id="address" class="form-control">
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Thêm mới</button>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
