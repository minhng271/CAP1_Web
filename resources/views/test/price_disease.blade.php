@extends('layouts.test')
@section('content')
<main class="content">
    @if (session('name_vac'))
                <div class="alert alert-success" style="margin-bottom:1px;">Cập nhật giá tiền tiêm test cho bệnh <b>{{ session('name_vac') }}</b></div>
            @endif
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12 col-lg-12 col-xxl-12">
                <div class="card-header  d-flex justify-content-between">
                    Xét giá tiền tiêm theo loại bệnh
                </div>
                <div class="card flex-fill">
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
                            @php
                                $count = 0;
                            @endphp
                            @if ($price_dis)
                                @foreach ($price_dis as $item)

                                    @php
                                        $count++;
                                    @endphp
                                    <tr>
                                        <td class="d-none d-xl-table-cell">{{ $count }}</td>
                                        <td class="d-none d-xl-table-cell">{{ $item->name }}</td>
                                        <td class="d-none d-xl-table-cell">{{ number_format($item->price_test) }} đ</td>
                                        <td class="d-none d-xl-table-cell">
                                        <a class="btn btn-warning" href="{{ url('test/price_test_edit',['id'=>$item->id]) }}">Chỉnh Sửa</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr style="background:#rgb(240 238 238);color: black;">
                                    <td></td>
                                    <td colspan="8">Không có bản ghi nào</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </div>
</main>
@endsection