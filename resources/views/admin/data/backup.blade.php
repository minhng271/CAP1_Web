@extends('layouts.admin')
@section('content')
    <style>
        .col-md-6.info-patient {
            border: 1px solid;
            border-radius: 8px;
            box-sizing: border-box;
            padding: 15px 20px;
            background: #fff;
            position: absolute;
            top: -22%;
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
        td.d-md-table-cell:hover>a:after {
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

        h3 {
            font-size: 1.5rem;
            font-weight: 500;
            text-transform: uppercase;
        }

    </style>
    <main class="content">


        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-12 col-lg-12 col-xxl-12">
                    <div class="card-header  d-flex justify-content-between">
                        <h3>Sao Lưu Dữ Liệu</h3>
                        <form class="col-md-4 d-flex justify-content-end" method="GET">
                            <input type="text" class='form-control' class="form-control" name="keyword"
                                value="{{ request()->input('keyword') }}" placeholder="Tìm Kiếm ...">
                            <input class="btn btn-primary ml-1" type="submit" value="Tìm Kiếm">
                        </form>
                    </div>

                    <div class="card flex-fill">
                        <form action="{{ route('our_backup_database') }}" method="post" style="min-height: 410px;display: flex;flex-direction: column;justify-content: space-between;">
                            @csrf
                            <table class="table table-hover my-0">
                                <thead>
                                    <tr>
                                        <th class="d-none d-xl-table-cell"><input id="selectAll" type="checkbox"></th>
                                        <th class="d-none d-xl-table-cell">STT</th>
                                        <th class="d-none d-xl-table-cell">Bảng</th>
                                        <th class="d-none d-md-table-cell">Trạng Thái</th>
                                        <th class="d-none d-xl-table-cell">Backup lần cuối</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $array = [];
                                    @endphp
                                    <tr>
                                        <td class="d-none d-xl-table-cell"><input name="hospitals" value="hospitals"
                                                type="checkbox"></td>
                                        <td class="d-none d-xl-table-cell">2</td>
                                        <td class="d-none d-xl-table-cell">Danh Sách Bệnh viện</td>
                                        <td class="d-none d-xl-table-cell"><span
                                                style=" display: inline-block; background: #00ff4e; padding: 3px 10px; border-radius: 4px; ">Hoạt
                                                động</span></td>
                                        <td class="d-none d-xl-table-cell">16/12/2021</td>
                                    </tr>

                                    <tr>
                                        <td class="d-none d-xl-table-cell"><input name="users" value="users"
                                                type="checkbox"></td>
                                        <td class="d-none d-xl-table-cell">2</td>
                                        <td class="d-none d-xl-table-cell">Tài Khoản Bệnh viện</td>
                                        <td class="d-none d-xl-table-cell"><span
                                                style=" display: inline-block; background: #00ff4e; padding: 3px 10px; border-radius: 4px; ">Hoạt
                                                động</span></td>
                                        <td class="d-none d-xl-table-cell">16/12/2021</td>
                                    </tr>

                                    <tr>
                                        <td class="d-none d-xl-table-cell"><input name="patients" value="patients"
                                                type="checkbox"></td>
                                        <td class="d-none d-xl-table-cell">3</td>
                                        <td class="d-none d-xl-table-cell">Danh Sách Người dùng</td>
                                        <td class="d-none d-xl-table-cell"><span
                                                style=" display: inline-block; background: #00ff4e; padding: 3px 10px; border-radius: 4px; ">Hoạt
                                                động</span></td>
                                        <td class="d-none d-xl-table-cell">16/12/2021</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-3 mr-3 d-flex justify-content-end">
                            <button class="btn btn-primary" style=" padding: 10px 40px; ">Sao Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
