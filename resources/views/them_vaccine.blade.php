@extends('layouts.admin')
@section('content')
    <style>

    </style>
    <div class="content">
        <h1 class="title">Thêm mới vắc xin</h1>
        <form action="">
            @csrf
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="name">Tên</label>
                    <input class="form-control" type="text" name="" id="name">
                </div>
                <div class="mb-3  col-md-6">
                    <label class="form-label" for="country">Quốc Gia</label>
                    <input class="form-control" type="text" name="" id="country">
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="age_use_from">Tuổi Tiêm Từ</label>
                    <input class="form-control" type="number" min="0" name="" id="age_use_from">
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="age_use_to">Tuổi Tiêm Đến</label>
                    <input class="form-control" type="number" min="0" name="" id="age_use_to">
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="type_disease">Loại Bệnh</label>
                    <select class="form-select" name="" id="type_disease">
                        <option selected value="">cô víc 18</option>
                        <option value="">2</option>
                        <option value="">3</option>
                        <option value="">4</option>
                        <option value="">5</option>
                    </select>
                </div>

            </div>
            <div class="row">
                <div class="mb-3 col-md-12">
                    <label class="form-label" for="description">Mô Tả Thêm</label>
                    <textarea class="col-md-12" name="" id="description" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Thêm mới</button>
            </div>
        </form>
    </div>
@endsection
