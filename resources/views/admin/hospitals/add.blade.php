@extends('layouts.admin')
@section('content')
    <style>
        .card-header.font-weight-bold {
            text-transform: uppercase;
            font-size: 1.7rem;
        }

    </style>
    <div id="content" class="container-fluid">
        <div class="card add">
            <div class="card-header font-weight-bold">
                Thêm Bệnh Viện
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
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Thêm mới</button>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
