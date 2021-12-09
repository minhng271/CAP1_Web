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
                        <div class="form-group col-md-4">
                            {!! Form::label('address', 'Đia Chỉ', []) !!}
                            {!! Form::text('address', $patient->address , ['class' => 'form-control', 'id' => 'address']) !!}
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('ward', 'Xã, Phường', []) !!}
                            {!! Form::text('ward', $patient->ward , ['class' => 'form-control', 'id' => 'ward']) !!}
                            @error('ward')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('district', 'Quận, Huyện', []) !!}
                            {!! Form::text('district', $patient->district , ['class' => 'form-control', 'id' => 'district']) !!}
                            @error('district')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-md-4">
                            {!! Form::label('city', 'Tỉnh, Thành Phố', []) !!}
                            {!! Form::text('city', $patient->city , ['class' => 'form-control', 'id' => 'city']) !!}
                            @error('city')
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
                    <a href="{{ url('admin/user', []) }}" class="btn btn-secondary" >Hủy</a>
    
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
