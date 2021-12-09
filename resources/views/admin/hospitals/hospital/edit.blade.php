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
                    <div class="form-group">
                        {!! Form::label('address', 'Địa Chỉ', []) !!}
                        {!! Form::text('address', "$hospital->address", ['class' => 'form-control', 'id' => 'address']) !!}
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary" name="submit_edit" value="{{$hospital->id}}">Thay Đổi</button>
                    <a href="{{ url('admin/hospital', []) }}" class="btn btn-secondary" >Hủy</a>
    
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
