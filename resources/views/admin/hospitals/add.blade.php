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
                    Thêm MỚI tài khoản quản lý Bệnh Viện
                </div>
                <div class="card-body">
                    {!! Form::open(['url' => 'admin/hospital-acc/store', 'method' => 'POST']) !!}
                    {!! Form::hidden('type', 'hospital', []) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Tên Bệnh Viện', []) !!}
                        <select class="form-select" name="name" id="name">
                            @foreach ($hospital as $item)
                            <option value="{{$item->name}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                   
                    <div class="form-group">
                        {!! Form::label('email', 'Email', []) !!}
                        {!! Form::email('email', '', ['class' => 'form-control', 'id' => 'email']) !!}
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', 'Mật khẩu', []) !!}
                        {!! Form::password('password', ['class' => 'form-control', 'id' => 'password']) !!}
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {!! Form::label('phone', 'Số Điện Thoại', []) !!}
                        {!! Form::text('phone', '', ['class' => 'form-control', 'id' => 'phone']) !!}
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        
                        {!! Form::label('type_hos', 'Quyền Sử Dụng', []) !!}
                        <select class="form-select" name="type_hos" id="type_hos">
                            <option value="null">không</option>
                            <option value="test">xét nghiệm</option>
                            <option value="vaccine">tiêm chủng</option>
                        </select>
                        @error('type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
        
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Thêm mới</button>
                    
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
