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
                    {!! Form::open(['url' => 'admin/hospital-acc/store/edit', 'method' => 'POST']) !!}
                    <div class="form-group">
                        {!! Form::label('email', 'Email', []) !!}
                        {!! Form::email('email', "$hospital->email", ['class' => 'form-control', 'id' => 'email']) !!}
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {!! Form::label('name', 'Tên Bệnh Viện', []) !!}
                        {!! Form::text('name', "$hospital->name", ['class' => 'form-control', 'id' => 'name']) !!}
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {!! Form::label('phone', 'Số Điện Thoại', []) !!}
                        {!! Form::text('phone', "$hospital->phone", ['class' => 'form-control', 'id' => 'phone']) !!}
                        @error('phone')
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
                    
                    <div class="form-group">
                        {!! Form::hidden('id_user', $hospital->id_user, []) !!}
                        {!! Form::label('type_hos', 'Quyền Sử Dụng', []) !!}
                        <select class="form-select" name="type_hos" id="type_hos">
                            <option @php if($hospital->type_hos == null)
                            echo 'selected';
                            @endphp value="null">không</option>
                            <option @php if($hospital->type_hos == 'test')
                            echo 'selected';
                            @endphp value="test">xét nghiệm</option>
                            <option @php if($hospital->type_hos == 'vaccine')
                            echo 'selected';
                            @endphp value="vaccine">tiêm chủng</option>
                        </select>
                        @error('type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary" name="submit_edit" value="{{$hospital->id}}">Thay Đổi</button>
                    <a href="{{ url('admin/hospital-acc', []) }}" class="btn btn-secondary" >Hủy</a>
    
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
