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

                                <tr>
                                    <td class="d-none d-xl-table-cell"><input name="name_check" type="checkbox"></td>
                                    <td class="d-none d-xl-table-cell">1</td>
                                    <td class="d-none d-xl-table-cell">Tài Khoản</td>
                                    <td class="d-none d-xl-table-cell"><span style=" display: inline-block; background: #00ff4e; padding: 3px 10px; border-radius: 4px; ">Hoạt động</span></td>
                                    <td class="d-none d-xl-table-cell">16/12/2021</td>
                                </tr>
                                <tr>
                                    <td class="d-none d-xl-table-cell"><input name="name_check" type="checkbox"></td>
                                    <td class="d-none d-xl-table-cell">2</td>
                                    <td class="d-none d-xl-table-cell">Bệnh viện</td>
                                    <td class="d-none d-xl-table-cell"><span style=" display: inline-block; background: #00ff4e; padding: 3px 10px; border-radius: 4px; ">Hoạt động</span></td>
                                    <td class="d-none d-xl-table-cell">16/12/2021</td>
                                </tr>

                                <tr>
                                    <td class="d-none d-xl-table-cell"><input name="name_check" type="checkbox"></td>
                                    <td class="d-none d-xl-table-cell">3</td>
                                    <td class="d-none d-xl-table-cell">Người dùng</td>
                                    <td class="d-none d-xl-table-cell"><span style=" display: inline-block; background: #00ff4e; padding: 3px 10px; border-radius: 4px; ">Hoạt động</span></td>
                                    <td class="d-none d-xl-table-cell">16/12/2021</td>
                                </tr>

                                <tr>
                                    <td class="d-none d-xl-table-cell"><input name="name_check" type="checkbox"></td>
                                    <td class="d-none d-xl-table-cell">4</td>
                                    <td class="d-none d-xl-table-cell">Vắc Xin</td>
                                    <td class="d-none d-xl-table-cell"><span style=" display: inline-block; background: #00ff4e; padding: 3px 10px; border-radius: 4px; ">Hoạt động</span></td>
                                    <td class="d-none d-xl-table-cell">16/12/2021</td>
                                </tr>

                                <tr>
                                    <td class="d-none d-xl-table-cell"><input name="name_check" type="checkbox"></td>
                                    <td class="d-none d-xl-table-cell">5</td>
                                    <td class="d-none d-xl-table-cell">Loại Bệnh</td>
                                    <td class="d-none d-xl-table-cell"><span style=" display: inline-block; background: #00ff4e; padding: 3px 10px; border-radius: 4px; ">Hoạt động</span></td>
                                    <td class="d-none d-xl-table-cell">16/12/2021</td>
                                </tr>

                                <tr>
                                    <td class="d-none d-xl-table-cell"><input name="name_check" type="checkbox"></td>
                                    <td class="d-none d-xl-table-cell">6</td>
                                    <td class="d-none d-xl-table-cell">Vắc xin-bệnh viện</td>
                                    <td class="d-none d-xl-table-cell"><span style=" display: inline-block; background: #00ff4e; padding: 3px 10px; border-radius: 4px; ">Hoạt động</span></td>
                                    <td class="d-none d-xl-table-cell">16/12/2021</td>
                                </tr>

                                <tr>
                                    <td class="d-none d-xl-table-cell"><input name="name_check" type="checkbox"></td>
                                    <td class="d-none d-xl-table-cell">7</td>
                                    <td class="d-none d-xl-table-cell">Vắc xin-Người dùng</td>
                                    <td class="d-none d-xl-table-cell"><span style=" display: inline-block; background: #00ff4e; padding: 3px 10px; border-radius: 4px; ">Hoạt động</span></td>
                                    <td class="d-none d-xl-table-cell">16/12/2021</td>
                                </tr>

                                <tr>
                                    <td class="d-none d-xl-table-cell"><input name="name_check" type="checkbox"></td>
                                    <td class="d-none d-xl-table-cell">8</td>
                                    <td class="d-none d-xl-table-cell">Xét Nghiệm - người dùng</td>
                                    <td class="d-none d-xl-table-cell"><span style=" display: inline-block; background: #00ff4e; padding: 3px 10px; border-radius: 4px; ">Hoạt động</span></td>
                                    <td class="d-none d-xl-table-cell">16/12/2021</td>
                                </tr>

                                <tr>
                                    <td class="d-none d-xl-table-cell"><input name="name_check" type="checkbox"></td>
                                    <td class="d-none d-xl-table-cell">9</td>
                                    <td class="d-none d-xl-table-cell">giới hạn đăng ký</td>
                                    <td class="d-none d-xl-table-cell"><span style=" display: inline-block; background: #00ff4e; padding: 3px 10px; border-radius: 4px; ">Hoạt động</span></td>
                                    <td class="d-none d-xl-table-cell">16/12/2021</td>
                                </tr>



                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Page navigation example" style=" display: flex; justify-content: space-between; margin: 0px 50px;align-items: center ">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#"><i
                                            class="fas fa-chevron-left"></i></a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#"><i
                                            class="fas fa-chevron-right"></i></a></li>
                            </ul>
                        </nav>

                        <button class="btn btn-primary" style=" padding: 10px 40px; ">Sao Lưu</button>
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
