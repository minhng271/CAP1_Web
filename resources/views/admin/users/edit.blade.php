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
                    Chỉnh sửa thông tin Người Dùng
                </div>
                <div class="card-body">
                    {!! Form::open(['url' => 'admin/user/store/edit', 'method' => 'POST']) !!}
                    <div class="row">
                        <div class="form-group col-md-6">
                            {!! Form::label('email', 'Email', []) !!}
                            {!! Form::email('email', $patient->email, ['class' => 'form-control', 'id' => 'email']) !!}
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group  col-md-6">
                            {!! Form::label('fullname', 'Tên Người Dùng', []) !!}
                            {!! Form::text('fullname', $patient->fullname , ['class' => 'form-control', 'id' => 'fullname']) !!}
                            @error('fullname')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="form-group  col-md-4">
                            {!! Form::label('id_card', 'CMND/CCCD', []) !!}
                            {!! Form::text('id_card', $patient->id_card , ['class' => 'form-control', 'id' => 'id_card']) !!}
                            @error('id_card')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group  col-md-4">
                            {!! Form::label('health_card', 'Thẻ BHYT', []) !!}
                            {!! Form::text('health_card', $patient->health_card , ['class' => 'form-control', 'id' => 'health_card']) !!}
                            @error('health_card')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group  col-md-4">
                            {!! Form::label('gender', 'Giới tính', []) !!}
                            <select name="gender" id="gender" class="form-select">
                                
                                <option value="">Chọn</option>
                                <option @php
                                    if($patient->gender == 'male') echo 'selected';
                                @endphp value="male">Nam</option>
                                <option @php
                                if($patient->gender == 'female') echo 'selected';
                            @endphp value="female">Nữ</option>
                            </select>
                            @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            {!! Form::label('birthDate', 'Ngày Sinh', []) !!}
                            <input type="date" value="{{$patient->birthDate }}" name="birthDate" id="birthDate" class="form-control" >
                            @error('birthDate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('job', 'Nghề nghiệp', []) !!}
                            {!! Form::text('job', $patient->job , ['class' => 'form-control', 'id' => 'job']) !!}
                            @error('job')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('phone', 'Số Điện Thoại', []) !!}
                            {!! Form::text('phone', $patient->phone , ['class' => 'form-control', 'id' => 'phone']) !!}
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            {!! Form::label('city', 'Tỉnh/ Thành Phố', []) !!}
                            <select name="city" id="city" class="form-select select_address">
                                <option value="">Tỉnh/ Thành Phố</option>
                                @foreach ($city as $val)
                                    <option @php
                                        if($patient->city == $val->name_city) echo 'selected';
                                    @endphp value="{{ $val->matp }}">{{ $val->name_city }}</option>
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
                            
                                @foreach ($province as $val)
                                <option @php
                                    if($patient->district == $val->name_province) echo 'selected';
                                @endphp value="{{ $val->maqh }}">{{ $val->name_province }}</option>
                            @endforeach

                            </select>
                            @error('province')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 form-group">
                            {!! Form::label('ward', 'Phường/ Xã', []) !!}
                            <select name="ward" id="ward" class="form-select">
                                <option value="">Chọn Phường/ Xã</option>
                                @foreach ($ward as $val)
                                <option @php
                                    if($patient->ward == $val->name_wards) echo 'selected';
                                @endphp value="{{ $val->xaid }}">{{ $val->name_wards }}</option>
                            @endforeach

                            </select>
                            @error('ward')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-md-4">
                            {!! Form::label('address', 'Địa Chỉ/ Số Nhà', []) !!}
                            <input type="text" name="address" id="address" class="form-control" value="{{$patient->address}}">
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group  col-md-4">
                            {!! Form::label('country', 'Quốc Gia', []) !!}
                            {!! Form::text('country', $patient->country , ['class' => 'form-control', 'id' => 'country']) !!}
                            @error('country')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group  col-md-4">
                            {!! Form::label('nation', 'Dân Tộc', []) !!}
                            {!! Form::text('nation', $patient->nation , ['class' => 'form-control', 'id' => 'nation']) !!}
                            @error('nation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit_edit" value="{{$patient->id_card}}">Thay Đổi</button>
                    <a href="{{ url('admin/users', []) }}" class="btn btn-secondary" >Hủy</a>
    
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
