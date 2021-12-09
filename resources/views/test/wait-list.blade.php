@extends('layouts.test')
@section('content')
    <style>
        td.d-none.d-md-table-cell {
            padding: 0px 12px !important;
        }

        td.d-none.d-xl-table-cell {
            padding: 0px !important;
        }

        td.d-none.d-xl-table-cell>span {
            display: block;
            padding: 12px;
        }

        td.d-none.d-md-table-cell>label {
            padding: 20px;
            margin: 0px;
            display: flex;
            height: 40px;
            width: 100%;
            justify-content: flex-start;
            align-items: center;
        }

        h3 {
            font-size: 1.5rem;
            font-weight: 500;
            text-transform: uppercase;
        }

    </style>
    <main class="content">

        <div class="container-fluid p-0">
            @if (session('status'))
                <div style=" margin-bottom: 1px; " class="alert alert-success">{{ session('status') }}</div>
            @endif
            <div class="row">
                <div class="col-12 col-lg-12 col-xxl-12">

                    <div class="card-header  d-flex justify-content-between">
                        <h3>Danh sách chờ xác nhận</h3>
                        <form class="col-md-4 d-flex" method="GET">
                            <input type="text" class="form-control" name="keyword"
                                value="{{ request()->input('keyword') }}" placeholder="Tìm Kiếm ...">
                            <input class="btn btn-primary ml-1" type="submit" value="Tìm Kiếm">
                        </form>
                    </div>
                    {!! Form::open(['url' => url('test/result')]) !!}
                    <div class="card flex-fill">
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="d-none d-xl-table-cell">STT</th>
                                    <th class="d-none d-xl-table-cell">Họ Tên</th>
                                    <th class="d-none d-xl-table-cell">CCCD/CMND</th>
                                    <th class="d-none d-xl-table-cell">Giới tính</th>
                                    <th class="d-none d-xl-table-cell">Ngày Sinh</th>
                                    <th class="d-none d-md-table-cell">Số Điện Thoại</th>
                                    <th class="d-none d-md-table-cell">Âm Tính</th>
                                    <th class="d-none d-md-table-cell">Dương Tính</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 0;
                                @endphp
                                @if ($patients)
                                    @foreach ($patients as $item)
                                        @php
                                            $count++;
                                        @endphp
                                        <tr>
                                            <th class="d-none d-xl-table-cell"><input type="checkbox" name="check[]"
                                                    value="{{ $item->id_card }}" id="{{ $item->id_card }}"></th>
                                            <td class="d-none d-xl-table-cell"><span>{{ $count }}</span></td>
                                            <td class="d-none d-xl-table-cell"><span>{{ $item->fullname }}</span></td>
                                            <td class="d-none d-xl-table-cell"><span>{{ $item->id_card }}</span></td>
                                            <td class="d-none d-xl-table-cell">
                                                <span>
                                                    @php
                                                        if ($item->gender == 'male') {
                                                            echo 'Nam';
                                                        } else {
                                                            echo 'Nữ';
                                                        }
                                                    @endphp
                                                </span>
                                            </td>
                                            <td class="d-none d-xl-table-cell">@php
                                                echo date('d-m-Y', strtotime($item->birthday));
                                            @endphp</td>
                                            <td class="d-none d-xl-table-cell"><span>{{ $item->phone }}</span></td>
                                            <td class="d-none d-md-table-cell">
                                                <label for="negative[{{ $item->id_card }}]" class="result">
                                                    <input type="radio" id="negative[{{ $item->id_card }}]"
                                                        name="result[{{ $item->id_card }}]" value="0">
                                                </label>

                                            </td>
                                            <td class="d-none d-md-table-cell">
                                                <label for="positive[{{ $item->id_card }}]" class="result">
                                                    <input type="radio" id="positive[{{ $item->id_card }}]"
                                                        name="result[{{ $item->id_card }}]" value="1">
                                                </label>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr style="background:#ececec;color: black;">
                                        <td></td>
                                        <td colspan="8">Không có bản ghi nào</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="submit d-flex justify-content-end">
                        <button style="margin-top: 10px;padding: 10px 20px;" type="submit"
                            onclick=" return confirm('XÁC NHẬN THÀNH CÔNG')" class="btn btn-primary">XÁC
                            NHẬN</button>
                    </div>
                    {!! Form::close() !!}
                    <nav aria-label="Page navigation example">
                        {{ $patients->links() }}
                    </nav>
                </div>

            </div>

        </div>
    </main>
@endsection
