@extends('layouts.vaccine')
@section('content')
    <div class="container-fluid p-0">

        <div class="content">
            @if (session('done_vac_hos'))
                <div class="alert alert-success">Thêm số lượng vắc xin <b>{{ session('done_vac_hos') }}</b> thành công
                </div>
            @endif
            <div class="row">
                <div class="col-12 col-lg-12 col-xxl-12">
                    <div class="card-header  d-flex justify-content-between">
                        <h3 style="text-transform: uppercase; font-weight: 600;">Nhập thêm số lượng vắc xin</h3>
                    </div>

                    <div class="card flex-fill">
                        <form method="POST" action="{{ url('vaccine/store-them-sl-vaccine') }}" style="padding: 50px;">
                            @csrf
                            <div class="row">


                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="type_disease">Loại Bệnh</label>
                                    <select class="form-select select_vaccine" name="type_disease" id="type_disease">
                                        <option value="" selected>Chọn Loại Bệnh</option>
                                        @foreach ($list_disease as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="name">Tên Vắc Xin</label>
                                    <select class="form-select" name="name" id="name_vac">
                                        <option value="" selected>Chọn Vắc Xin</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-4">
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
                                    <input class="form-control" type="date" name="date_of_manufacture"
                                        id="date_of_manufacture">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="out_of_date">Ngày hết hạn</label>
                                    <input class="form-control" type="date" name="out_of_date" id="out_of_date">
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary" name="submit" value="submit"
                                    onclick="return confirm('Xác nhận nhập đúng số liệu')">Thêm Số Lượng</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    @endsection
