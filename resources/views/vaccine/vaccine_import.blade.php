@extends('layouts.vaccine')
@section('content')

    
    <div class="content">
        @if (session('done_vac_hos'))
                <div class="alert alert-success">Thêm số lượng vắc xin <b>{{ session('done_vac_hos') }}</b> thành công </div>
                <br>
    @endif
        <h1 class="title">Nhập thêm số lượng vắc xin</h1>
    <form action="{{ url('vaccine/store-them-sl-vaccine') }}">
        @csrf
        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label" for="name">Tên</label>
                <select class="form-select"  name="name" id="name">
                    @foreach ($list_vac as $item)
                        <option value="{{$item->name}}">{{$item->name}}</option>
                    @endforeach
                    
                </select>
            </div>
            
            <div class="mb-3 col-md-6">
                <label class="form-label" for="number">Số Lượng</label>
                <input class="form-control" type="number" min='0' name="quantity" id="number">
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-md-4">
                <label class="form-label" for="lot_number">Số Lô</label>
                <input class="form-control" type="text" name="lot_number" id="lot_number">
            </div>
            <div class="mb-3 col-md-4">
                <label class="form-label" for="date_of_manufacture">Ngày sản xuất</label>
                <input class="form-control" type="date" name="date_of_manufacture" id="date_of_manufacture">
            </div>
            <div class="mb-3 col-md-4">
                <label class="form-label" for="out_of_date">Ngày hết hạn</label>
                <input class="form-control" type="date"name="out_of_date" id="out_of_date">
            </div>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="submit" value="submit" onclick="return confirm('ok k cu')">Thêm Số Lượng</button>    
        </div>
    </form>
    </div>
@endsection
