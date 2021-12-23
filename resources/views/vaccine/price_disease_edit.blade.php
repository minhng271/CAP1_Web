@extends('layouts.vaccine')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12 col-lg-12 col-xxl-12">
                    <div class="card-header  d-flex justify-content-between">
                        Chỉnh sửa giá tiền cho bệnh {{ $price_dis->name }}
                    </div>
                    <div class="card flex-fill">
                        <form action="{{ url('vaccine/price_update') }}" method="post">
                            @csrf
                            <table class="table table-hover my-0">
                                <thead>
                                    <tr>
                                        <th class="d-none d-xl-table-cell">#</th>
                                        <th class="d-none d-xl-table-cell">Tên Bệnh</th>
                                        <th class="d-none d-md-table-cell">Giá Tiền</th>
                                        <th>Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="d-none d-xl-table-cell">1</td>
                                        <td class="d-none d-xl-table-cell">{{ $price_dis->name }}</td>
                                        <td class="d-none d-xl-table-cell">
                                            <input type="number" min="0" class="form-control" name="price_vac"
                                                value="{{ $price_dis->price_vac }}" required>
                                                <input type="hidden" name="id" value="{{$price_dis->id}}">
                                        </td>
                                        <td class="d-none d-xl-table-cell">
                                            <button type="submit" class="btn btn-primary">Xác nhận</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
