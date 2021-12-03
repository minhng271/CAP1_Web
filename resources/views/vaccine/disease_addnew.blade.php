@extends('layouts.vaccine')
@section('content')

    <div class="content">
        @if (session('errorNameDisease'))
            <div class="alert alert-success">Loại Bệnh: <b>{{ session('errorNameDisease') }}</b> Đã Tồn Tại. Kiểm tra lại trong danh sách loại bệnh đã xóa</div>
            <br>
        @endif
        @if (session('nameDisease'))
            <div class="alert alert-success">Thêm mới loại bệnh: <b>{{ session('nameDisease') }}</b> thành công</div>
            <br>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 style=" font-weight: 600; text-transform: uppercase; ">Thêm mới loại bệnh</h3>
            </div>
            <div class="card-body">
                <form action="{{ url('vaccine/store-addnew-disease') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="disease">Tên Loại Bệnh</label>
                        <input class="form-control" id="disease" type="text" value="" name="disease">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="symptom">Triệu Chứng</label>
                        <textarea class="form-control" name="symptom" id="symptom" cols="30" rows="10"></textarea>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" name="submit" value="submit" type="submit">Xác Nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
