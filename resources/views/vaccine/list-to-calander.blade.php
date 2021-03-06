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
        @if (session('done_patient'))
                <div class="alert alert-success">Đã chuyển <b>{{ session('done_patient') }}</b> vào danh sách chờ Xác
                    Nhận</div>
                <br>
            @endif
            @if (session('delete_patient'))
                <div class="alert alert-success">Xóa <b>{{ session('delete_patient') }}</b> Khỏi danh sách chờ thành
                    công</div>
                <br>
            @endif
        <div class="container-fluid p-0">           
            <div class="row">
                <div class="col-12 col-lg-12 col-xxl-12">
                    <div class="card-header  d-flex justify-content-between">
                        <h3 class="col-md-6">Tra Danh Sách Theo Lịch</h3>
                        {{-- <form class="col-md-4 d-flex justify-content-end" method="GET">
                            <input type="text" class='form-control' class="form-control" name="keyword"
                                value="{{ request()->input('keyword') }}" placeholder="Tìm Kiếm ...">
                            <input class="btn btn-primary ml-1" type="submit" value="Tìm Kiếm">
                        </form> --}}
                           <form action="" method="get" class="col-md-6 row d-flex justify-content-end">
                            <div class="col-md-6">  
                                <input type="text" id="from_date" name="created_at" 
                                value="@if(request()->input('created_at')){{request()->input('created_at')}}@else{{$created_at}}@endif" readonly="readonly" class="form-control" />  
                           </div>
                            <div class="col-md-3">  
                                <button type="submit" name="filter" id="filter" class="btn btn-info w-100">Tra cứu</button>  
                           </div> 
                           </form>
                    </div>
                    <div class="card flex-fill" >
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th class="d-none d-xl-table-cell">STT</th>
                                    <th class="d-none d-xl-table-cell">Họ Tên</th>
                                    <th class="d-none d-md-table-cell">CCCD/CMND</th>
                                    <th class="d-none d-xl-table-cell">Giới tính</th>
                                    <th class="d-none d-xl-table-cell">Ngày Sinh</th>
                                    <th class="d-none d-md-table-cell">Số Điện Thoại</th>
                                    <th class="d-none d-md-table-cell">Lần Tiêm</th>
                                    <th class="d-none d-md-table-cell">Tên Vắc Xin</th>
                                    <th>Trạng Thái</th>
                                    <th>Thanh Toán</th>
                                    <th>Thông tin</th>
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
                                            <td class="d-none d-xl-table-cell">{{ $item->fullname }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $item->health_card }}</td>
                                            <td class="d-none d-xl-table-cell">@php
                                                if ($item->gender == 'male') {
                                                    echo 'Nam';
                                                } else {
                                                    echo 'Nữ';
                                                }
                                            @endphp</td>
                                            <td class="d-none d-xl-table-cell">@php
                                                echo date('d-m-Y', strtotime($item->birthday));
                                            @endphp</td>
                                                <td class="d-none d-xl-table-cell">{{ $item->phone }}</td>
                                                <td class="d-none d-xl-table-cell">{{ $item->injection_times }}</td>
                                                <td class="d-none d-xl-table-cell">@php
                                                    if(DB::table('vaccines')->where('id',$item->id_vac)->first()){
                                                        echo DB::table('vaccines')->where('id',$item->id_vac)->first()->name;
                                                    }
                                                @endphp</td>
                                                
                                                <td>
                                                    @if ($item->done_inject == 0)
                                                    <span style='color: white;background: #f12d2d;padding: 4px 6px;border-radius: 4px;'>Chưa Tiêm</span>
                                                    @else
                                                    <span style='background: #39f639;padding: 4px 6px;border-radius: 4px;'>Đã Tiêm</span>
                                                    @endif
                                                </td>
                                                <td class="d-none d-xl-table-cell"><span class="@php
                                                    if($item->status == "Đã thanh toán") echo 'done';
                                                    else echo 'undone';
                                                @endphp">{{ $item->status }}</span></td>
                                            <td class="d-none d-md-table-cell d-user" data="{{ $item->id_card }}">
                                                <i class="far fa-user" style="color: #3b7ddd;display: flex;    justify-content: center;"></i>
                                            </td>
                                            
                                        </tr>



                                        <div class="col-md-6 info-patient d-none" id="{{ $item->id_card }}">
                                            <form action="">
                                                <h3>ThÔNG TIN BỆNH NHÂN</h3>

                                                <div class="info">
                                                    <div class="mb d-flex">
                                                        <label for="" class='form-label'>Họ Và Tên</label>
                                                        <input type="text" class='form-control w-50'
                                                            value="{{ $item->fullname }}">
                                                    </div>
                                                    <div class="mb d-flex">
                                                        <label for="" class='form-label'>CMND/CCCD</label>
                                                        <input type="text" class='form-control w-50'
                                                            value="{{ $item->health_card }}">
                                                    </div>
                                                    <div class="mb d-flex">
                                                        <label for="" class='form-label'>Ngày Sinh</label>
                                                        <input type="text" class='form-control w-50'
                                                            value="@php
                                                                echo date('d-m-Y', strtotime($item->birthday));
                                                            @endphp">
                                                    </div>
                                                    <div class="mb d-flex">
                                                        <label for="" class='form-label'>Giới tính</label>
                                                        <div class="mb d-flex-gender">
                                                            <input type="radio" @php
                                                                if ($item->gender == 'male') {
                                                                    echo 'checked';
                                                                }
                                                            @endphp name="gender" value="male"
                                                                id="male[{{ $item->id_card }}]"> <label
                                                                for="male[{{ $item->id_card }}]">Nam</label>
                                                            <input type="radio" @php
                                                                if ($item->gender == 'female') {
                                                                    echo 'checked';
                                                                }
                                                            @endphp name="gender"
                                                                value="female" id="female[{{ $item->id_card }}]"><label
                                                                for="female[{{ $item->id_card }}]">Nữ</label>
                                                        </div>
                                                    </div>

                                                    <div class="mb d-flex">
                                                        <label for="" class='form-label'>Số Điện thoại</label>
                                                        <input type="text" class='form-control w-50'
                                                            value="{{ $item->phone }}">
                                                    </div>
                                                    <div class="mb d-flex">
                                                        <label for="" class='form-label'>Địa chỉ</label>
                                                        <input type="text" class='form-control w-50'
                                                            value="{{ $item->address }}">
                                                    </div>
                                                    <div class="mb d-flex">
                                                        <label for="" class='form-label'>Lần tiêm</label>
                                                        <input type="text" class='form-control w-50'
                                                            value="{{ $item->injection_times }}">
                                                    </div>
                                                </div>

                                                <div class="mb-3 d-flex mb-submit justify-content-end mt-3">
                                                    <span class="btn btn-primary btn-d-none"
                                                        data='{{ $item->id_card }}'>Xác Nhận</span>
                                                </div>
                                            </form>
                                        </div>
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
                        {{ $vaccines->links('vaccine.bootstrap-4',['created_at'=>request()->input('created_at')]) }}
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