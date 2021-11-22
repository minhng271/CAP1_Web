@extends('layouts.vaccine')
@section('content')
    <style>
        .col-md-6.info-patient {
            border: 1px solid;
            border-radius: 8px;
            box-sizing: border-box;
            padding: 15px 20px;
            background: #fff;
            position: absolute;
            top: -8%;
            left: 25%;
        }

        .col-md-6.info-patient h3 {
            font-size: 1.5rem;
            text-transform: uppercase;
            font-weight: 400;
            text-align: center;
            display: block;
            padding: 8px;
        }

        td.d-none.d-md-table-cell {
            position: relative;
        }

        .d-md-table-cell:hover td.d-md-table-cell:after,
        .d-md-table-cell:hover i {
            color: red;
            opacity: 100%;
        }
        
        .d-user:hover>i:after,
        td.d-md-table-cell:hover>a:after{
            width: 100%;
            opacity: 100%;
        }

        .d-user>i:after,
        td.d-md-table-cell>a:after {
            content: '';
            width: 0%;
            height: 2px;
            background: red;
            position: absolute;
            bottom: 0px;
            left: 0px;
            transition: 0.4s cubic-bezier(0.19, 1, 0.22, 1);
            opacity: 0;
        }


    </style>
    <main class="content">
        <div class="container-fluid p-0">
            @if (session('update_vaccine'))
                <span class="alert alert-success">Cập nhật vắc xin <b>{{ session('update_vaccine') }}</b> Thành Công</span>
            @endif
            @if (session('delete_vaccine'))
                <span class="alert alert-success">Xóa <b>{{ session('delete_vaccine') }}</b> Khỏi danh sách chờ thành công</span>
            @endif
            <div class="row">
                <div class="col-12 col-lg-12 col-xxl-12">
                    <div class="card-header  d-flex justify-content-between">
                        <h3 style="text-transform: uppercase; font-weight: 600;">Danh sách Thông tin Vaccine</h3>
                        <form class="col-md-4 d-flex justify-content-end" method="GET">
                            <input type="text" class='form-control' class="form-control" name="keyword"
                                value="{{ request()->input('keyword') }}" placeholder="Tìm Kiếm ...">
                            <input class="btn btn-primary ml-1" type="submit" value="Tìm Kiếm">
                        </form>
                    </div>
                    <div class="card flex-fill">
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th class="d-none d-xl-table-cell">STT</th>
                                    <th class="d-none d-xl-table-cell">Tên Vắc Xin</th>
                                    <th class="d-none d-md-table-cell">Quốc Gia</th>
                                    <th class="d-none d-xl-table-cell">Tuổi dùng từ</th>
                                    <th class="d-none d-xl-table-cell">tuổi dùng tới</th>
                                    <th class="d-none d-md-table-cell">Ngày Nhập</th>
                                    <th class="d-none d-md-table-cell">Ngày Sản Xuất</th>
                                    <th class="d-none d-md-table-cell">Hạn Sử Dụng</th>
                                    <th class="d-none d-md-table-cell">Số Lô</th>
                                    <th class="d-none d-md-table-cell">Số Lượng</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 0;
                                @endphp
                                @if ($vaccines)
                                    @foreach ($vaccines as $item)

                                        @php
                                            $count++;
                                        @endphp
                                        <tr>
                                            <td class="d-none d-xl-table-cell">{{ $count }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $item->name }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $item->country }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $item->age_use_from }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $item->age_use_to }}</td>
                                            <td class="d-none d-xl-table-cell">@php
                                                echo date("d-m-Y", strtotime($item->date_add));
                                            @endphp</td>
                                            <td class="d-none d-xl-table-cell">@php
                                                echo date("d-m-Y", strtotime($item->date_of_manufacture));
                                            @endphp</td>
                                            <td class="d-none d-xl-table-cell">@php
                                                echo date("d-m-Y", strtotime($item->out_of_date));
                                            @endphp</td>
                                            <td class="d-none d-xl-table-cell">{{ $item->lot_number }}</td>
                                            <td class="d-none d-xl-table-cell" style="color: #ff2525">{{ $item->quantity }}</td>
                                            
                                            <td class="d-none d-md-table-cell" id="done[{{ $item->id }}]">
                                                <a href="{{ url('vaccine/edit-vaccine', ['id' => $item->id]) }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                            <td class="d-none d-md-table-cell" id="delete[{{ $item->id }}]">
                                                <a href="{{ url('vaccine/delete-vaccine', ['id' => $item->id]) }}"
                                                    onclick="return confirm('XÓA VACCINE NÀY')">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </td>
                                            {{-- <td class="d-none d-md-table-cell d-user" data="{{ $item->id }}">
                                                <i class="far fa-user" style="color: #3b7ddd;"></i>
                                            </td> --}}
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
                    <nav aria-label="Page navigation example">
                        {{ $vaccines->links() }}
                    </nav>
                </div>

            </div>

        </div>

        <div class="container">
            <div class="row">

            </div>
        </div>
    </main>

@endsection