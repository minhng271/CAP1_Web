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
    <div id="content" class="container-fluid">
        <div class="card add">
            <div class="card-header font-weight-bold">
                Chỉnh sửa thông tin Người Dùng
            </div>
            <div class="card-body">
                {!! Form::open(['url' => 'admin/user/store/edit', 'method' => 'POST']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Tên Người Dùng', []) !!}
                    {!! Form::text('name', "$user->name", ['class' => 'form-control', 'id' => 'name']) !!}
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email', []) !!}
                    {!! Form::email('email', "$user->email", ['class' => 'form-control', 'id' => 'email','disabled']) !!}
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('address', 'Địa Chỉ', []) !!}
                    {!! Form::text('address', "$user->address", ['class' => 'form-control', 'id' => 'address']) !!}
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- <div class="form-group">
                    {!! Form::label('password', 'Mật khẩu Cũ', []) !!}
                    {!! Form::password('password_old', ['class' => 'form-control', 'id' => 'password']) !!}
                    @error('password_old')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Mật khẩu Mới', []) !!}
                    {!! Form::password('password_new', ['class' => 'form-control', 'id' => 'password']) !!}
                    @error('password_new')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Nhập lại Mật khẩu Mới', []) !!}
                    {!! Form::password('password_confirm', ['class' => 'form-control', 'id' => 'password']) !!}
                    @error('password_confirm')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> --}}
                <button type="submit" class="btn btn-primary" name="submit_edit" value="{{$user->id}}">Thay Đổi</button>
                <a href="{{ url('admin/user', []) }}" class="btn btn-secondary" >Hủy</a>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
