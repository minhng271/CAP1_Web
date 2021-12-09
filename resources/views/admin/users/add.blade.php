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
                    Thêm Người Dùng
                </div>
                <div class="card-body">
                    {!! Form::open(['url' => 'admin/user/store', 'method' => 'POST']) !!}
                    
                    <div class="row">
                        <div class="form-group col-md-6">
                            {!! Form::label('email', 'Email', []) !!}
                            {!! Form::email('email', '', ['class' => 'form-control', 'id' => 'email']) !!}
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('password', 'Mật khẩu', []) !!}
                            {!! Form::password('password', ['class' => 'form-control', 'id' => 'password']) !!}
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group  col-md-3">
                            {!! Form::label('fullname', 'Tên Người Dùng', []) !!}
                            {!! Form::text('fullname', '', ['class' => 'form-control', 'id' => 'fullname']) !!}
                            @error('fullname')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group  col-md-3">
                            {!! Form::label('id_card', 'CMND/CCCD', []) !!}
                            {!! Form::text('id_card', '', ['class' => 'form-control', 'id' => 'id_card']) !!}
                            @error('id_card')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group  col-md-3">
                            {!! Form::label('health_card', 'Thẻ BHYT', []) !!}
                            {!! Form::text('health_card', '', ['class' => 'form-control', 'id' => 'health_card']) !!}
                            @error('health_card')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group  col-md-3">
                            {!! Form::label('gender', 'Giới tính', []) !!}
                            <select name="gender" id="gender" class="form-select">
                                <option value="">Chọn</option>
                                <option value="male">Nam</option>
                                <option value="female">Nữ</option>
                            </select>
                            @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            {!! Form::label('birthDate', 'Ngày Sinh', []) !!}
                            <input type="date" name="birthDate" id="birthDate" class="form-control" >
                            @error('birthDate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('job', 'Nghề nghiệp', []) !!}
                            {!! Form::text('job', '', ['class' => 'form-control', 'id' => 'job']) !!}
                            @error('job')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('phone', 'Số Điện Thoại', []) !!}
                            {!! Form::text('phone', '', ['class' => 'form-control', 'id' => 'phone']) !!}
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            {!! Form::label('address', 'Đia Chỉ', []) !!}
                            {!! Form::text('address', '', ['class' => 'form-control', 'id' => 'address']) !!}
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('ward', 'Xã, Phường', []) !!}
                            {!! Form::text('ward', '', ['class' => 'form-control', 'id' => 'ward']) !!}
                            @error('ward')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('district', 'Quận, Huyện', []) !!}
                            {!! Form::text('district', '', ['class' => 'form-control', 'id' => 'district']) !!}
                            @error('district')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-md-4">
                            {!! Form::label('city', 'Tỉnh, Thành Phố', []) !!}
                            {!! Form::text('city', '', ['class' => 'form-control', 'id' => 'city']) !!}
                            @error('city')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group  col-md-4">
                            {!! Form::label('country', 'Quốc Gia', []) !!}
                            {!! Form::text('country', '', ['class' => 'form-control', 'id' => 'country']) !!}
                            @error('country')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group  col-md-4">
                            {!! Form::label('nation', 'Dân Tộc', []) !!}
                            {!! Form::text('nation', '', ['class' => 'form-control', 'id' => 'nation']) !!}
                            @error('nation')
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
