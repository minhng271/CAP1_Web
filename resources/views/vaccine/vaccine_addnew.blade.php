@extends('layouts.vaccine')
@section('content')
    <style>

    </style>
    <div class="content">
        @if (session('nameVaccine'))
            <div class="alert alert-success">đã thêm <b>{{session('nameVaccine')}}</b> vào danh sách vắc xin</div>
        @endif
        <h1 class="title">Thêm mới vắc xin</h1>
        <form action="{{ url('vaccine/store-addnew-vaccine') }}" method="POST">
            @csrf
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="name">Tên</label>
                    <input class="form-control" type="text" name="name" id="name">
                    @error('name')
                        <span class="text-danger" style="margin-top:5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3  col-md-6">
                    <label class="form-label" for="country">Quốc Gia</label>
                    <input class="form-control" type="text" name="country" id="country">
                    @error('country')
                        <span class="text-danger" style="margin-top:5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="age_use_from">Tuổi Tiêm Từ</label>
                    <input class="form-control" type="number" min="0" name="age_use_from" id="age_use_from">
                    @error('age_use_from')
                        <span class="text-danger" style="margin-top:5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="age_use_to">Tuổi Tiêm Đến</label>
                    <input class="form-control" type="number" min="0" name="age_use_to" id="age_use_to">
                    @error('age_use_to')
                        <span class="text-danger" style="margin-top:5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="type_disease">Loại Bệnh</label>
                    <select class="form-select" name="type_disease" id="type_disease">
                        @foreach ($diseases as $item)
                            <option value="{{$item->name}}">{{ $item->name }}</option>
                        @endforeach
                        @error('type_disease')
                            <span class="text-danger" style="margin-top:5px; display: block;">{{ $message }}</span>
                        @enderror
                    </select>
                </div>

            </div>
            <div class="row">
                <div class="mb-3 col-md-12">
                    <label class="form-label" for="description">Mô Tả Thêm</label>
                    <textarea class="col-md-12" name="description" id="description" cols="30" rows="10"></textarea>
                    @error('description')
                        <span class="text-danger" style="margin-top:5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Thêm mới</button>
            </div>
        </form>
    </div>
@endsection
