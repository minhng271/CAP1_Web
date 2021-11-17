@extends('layouts.admin')
@section('content')
    <div class="content">
        <h1 class="title">Nhập thêm số lượng vắc xin</h1>
    <form action="">
        @csrf
        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label" for="name">Tên</label>
                <select class="form-select"  name="" id="name">
                    <option selected value="">AstraZeneca</option>
                    <option value="">2</option>
                    <option value="">3</option>
                    <option value="">4</option>
                    <option value="">5</option>
                </select>
            </div>
            
            <div class="mb-3 col-md-6">
                <label class="form-label" for="number">Số Lượng</label>
                <input class="form-control" type="number" min='0' name="" id="number">
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-md-3">
                <label class="form-label" for="storage">Số Lô</label>
                <input class="form-control" type="text" name="" id="storage">
            </div>
            <div class="mb-3 col-md-3">
                <label class="form-label" for="date">Ngày Nhập</label>
                <input class="form-control" type="date" name="" id="date">
            </div>
            <div class="mb-3 col-md-3">
                <label class="form-label" for="date_of_manufacture">Ngày sản xuất</label>
                <input class="form-control" type="date" name="" id="date_of_manufacture">
            </div>
            <div class="mb-3 col-md-3">
                <label class="form-label" for="exp_date">Ngày hết hạn</label>
                <input class="form-control" type="date"name="" id="exp_date">
            </div>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="submit" value="submit" onclick="return confirm('ok k cu')">Thêm Số Lượng</button>    
        </div>
    </form>
    </div>
@endsection
