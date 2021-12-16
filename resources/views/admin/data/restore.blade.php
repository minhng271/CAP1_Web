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
                        <h3>Khôi Phục Dữ Liệu</h3>
                       
                    </div>

                    <div class="card flex-fill" style="min-height: 340px">
                        <div class="card-80" style=" width: 90%; margin: 0px auto; margin-top: 20px;">
                            <div class="mb-3">
                                <span style=" font-weight: 600; display: block; border-bottom: 1px solid; margin-bottom: 10px; ">Tập tin để nhập:</span>
                                <p>
                                    Tập tin có thể nén (gzip, bzip2, zip) hoặc không.
                                    <br>
                                    A compressed file's name must end in <strong>.[format].[compression]</strong>. Example:
                                    <strong>.sql.zip</strong>
                                </p>
                                <span>Duyệt máy tính của bạn: <input type="file" name="import_file"
                                        id="input_import_file"></span> <span>(T.Đa: 40MiB)</span>
                            </div>

                            <div class="mb-3">
                                <span style=" font-weight: 600; display: block; border-bottom: 1px solid; margin-bottom: 10px; ">Những tùy chọn khác:</span>
                                <span><input type="checkbox"> Bật kiểm tra khóa ngoại</span>
                            </div>

                            <div class="mb-3">
                                <span>Định dạng:</span>
                                <select name="" id="">
                                    <option value="">Bảng MediaWiki</option>
                                    <option selected value="">SQL</option>
                                    <option value="">Tập tin hình ESRI</option>
                                    <option value="">SML</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <nav aria-label="Page navigation example"
                        >
                        <button class="btn btn-primary" style=" padding: 10px 40px; ">Khôi Phục</button>
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
