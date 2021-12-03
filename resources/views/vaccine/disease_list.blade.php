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
            @if (session('name'))
                <span style=" margin-top: 4px; " class="alert alert-success">Cập nhật  loại bệnh <b>{{ session('name') }}</b> Thành Công</span>
            @endif
            @if (session('delete'))
                <span style=" margin-top: 4px; " class="alert alert-success">Xóa <b>{{ session('delete') }}</b> Khỏi danh sách chờ thành công</span>
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
                                    <th colspan="1" class="d-none d-xl-table-cell">STT</th>
                                    <th colspan="3" class="d-none d-xl-table-cell" style="border-left: 1px solid rgb(207, 207, 207);border-right: 1px solid rgb(207, 207, 207) ">Tên Bệnh</th>
                                    <th colspan="8" class="d-none d-xl-table-cell text-center">Vắc Xin Ngừa Bệnh</th>
                                    <th colspan="2" class="d-none d-xl-table-cell" style="border-left: 1px solid rgb(207, 207, 207); text-align: center;  border-right: 1px solid rgb(207, 207, 207) ">Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 0;
                                @endphp
                                @if ($list_disease)
                                    @php
                                        $count_item = 0;
                                    @endphp
                                    @foreach ($list_disease as $disease)

                                        @php
                                            $count++;
                                        @endphp
                                        <tr>
                                            <td colspan="1" class="d-none d-xl-table-cell">{{ $count }}</td>
                                            <td colspan="3" class="d-none d-xl-table-cell" style="border-left: 1px solid rgb(207, 207, 207);border-right: 1px solid rgb(207, 207, 207) ">
                                            {{$disease['name']}}
                                            </td>
                                            <td colspan="8" class="d-none d-xl-table-cell">                           
                                            @php
                                      
                                                foreach ($disease['vaccine'] as $item){
                                                    echo $item['name'].', ';
                                                }
                                            @endphp
                                            </td>
                                            
                                            <td class="d-none d-md-table-cell" id="done[]"
                                                style="border-left: 1px solid rgb(207, 207, 207);">
                                                <a href="{{ url('vaccine/edit-disease', ['id' =>  $disease['id']]) }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                            <td class="d-none d-md-table-cell" id="delete[]"
                                                style="border-right: 1px solid rgb(207, 207, 207) ">
                                                <a href="{{ url('vaccine/delete-disease', ['id' => $disease['id']]) }}"
                                                    onclick="return confirm('XÓA LOẠI BỆNH NÀY')">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
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
                    <nav aria-label="Page navigation example">
                        {{-- {{ $vaccines->links() }} --}}
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
