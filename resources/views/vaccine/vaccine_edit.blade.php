@extends('layouts.vaccine')
@section('content')
    <style>

    </style>
    <div class="content">
        <h1 class="title">Chỉnh sửa thông tin vắc xin</h1>
        <form action="{{ url('vaccine/store-edit-vaccine') }}" method="POST">
            @csrf
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="name">Tên</label>
                    <input class="form-control" type="text" name="name" id="name" disabled value="{{$vaccines->name}}">
                    <input type="hidden" name="id" value="{{$id}}">
                    @error('name')
                        <span class="text-danger" style="margin-top:5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3  col-md-6">
                    <label class="form-label" for="country">Quốc Gia</label>
                    <input class="form-control" type="text" name="country" id="country" value="{{$vaccines->country}}">
                    @error('country')
                        <span class="text-danger" style="margin-top:5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="age_use_from">Tuổi Tiêm Từ</label>
                    <input class="form-control" type="number" min="0" name="age_use_from" id="age_use_from" value="{{$vaccines->age_use_from}}">
                    @error('age_use_from')
                        <span class="text-danger" style="margin-top:5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="age_use_to">Tuổi Tiêm Đến</label>
                    <input class="form-control" type="number" min="0" name="age_use_to" id="age_use_to" value="{{$vaccines->age_use_to}}">
                    @error('age_use_to')
                        <span class="text-danger" style="margin-top:5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="type_disease">Loại Bệnh</label>
                    <select class="form-select" name="type_disease" id="type_disease" >
                        @foreach ($diseases as $item)
                            <option 
                            @php
                                if($item->name == $vaccines->diseases){
                                    echo "selected";
                                }
                            @endphp 
                            value="{{$item->name}}">{{ $item->name }}</option>
                        @endforeach
                        @error('type_disease')
                            <span class="text-danger" style="margin-top:5px; display: block;">{{ $message }}</span>
                        @enderror
                    </select>
                </div>

            </div>
            <div class="row">
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="lot_number">Số Lô</label>
                    <input class="form-control" type="text" name="lot_number" id="lot_number" value="{{$vac_hos->lot_number}}">
                    @error('lot_number')
                        <span class="text-danger" style="margin-top:5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="date_of_manufacture">Ngày Sản Xuất</label>
                    <input class="form-control" type="date" min="0" name="date_of_manufacture" id="date_of_manufacture" value="{{$vac_hos->date_of_manufacture}}">
                    @error('date_of_manufacture')
                        <span class="text-danger" style="margin-top:5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="out_of_date">Hạn Sử Dụng</label>
                    <input class="form-control" type="date" min="0" name="out_of_date" id="out_of_date" value="{{$vac_hos->out_of_date}}">
                    @error('out_of_date')
                        <span class="text-danger" style="margin-top:5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="row">
                <div class="mb-3 col-md-12">
                    <label class="form-label" for="description">Mô Tả Thêm</label>
                    <textarea class="col-md-12" name="description" id="description" cols="30" rows="10">{{$vaccines->description}}</textarea>
                    @error('description')
                        <span class="text-danger" style="margin-top:5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Lưu Chỉnh Sửa</button>
            </div>
        </form>
    </div>
@endsection
