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
            top: 2%;
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
        .d-user-2:hover>i:after,
        td.d-md-table-cell:hover>a:after {
            width: 100%;
            opacity: 100%;
        }

        .d-user>i:after,
        .d-user-2>i:after,
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
    <div class="content">
        @if (session('done_patient'))
                <div class="alert alert-success" style="margin-bottom:1px;">Tiêm cho <b>{{ session('done_patient') }}</b> thành công </div>
            @endif
            @if (session('delete_vaccine'))
                <div class="alert alert-success" style="margin-bottom:1px;">Chuyển <b>{{ session('delete_vaccine') }}</b> vào danh sách chờ thành
                    công</div>
            @endif
            @if (session('quantity_zero'))
                <div class="alert alert-success" style="margin-bottom:1px;">Không thành công !!!Vắc xin <b>{{ session('quantity_zero') }}</b> đã hết số lượng </div>
            @endif
        <div class="container-fluid p-0">
            
            <div class="row">
                <div class="col-12 col-lg-12 col-xxl-12">
                    <div class="card-header  d-flex justify-content-between">
                        <h3 style="text-transform: uppercase; font-weight: 600;">Danh sách Tiêm Vaccine hôm nay</h3>
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
                                    <th class="d-none d-xl-table-cell">Họ Tên</th>
                                    <th class="d-none d-xl-table-cell">Ngày Sinh</th>
                                    <th class="d-none d-md-table-cell">CCCD/CMND</th>
                                    <th class="d-none d-xl-table-cell">Số Thẻ BHYT</th>
                                    <th class="d-none d-md-table-cell">Số Điện Thoại</th>
                                    <th colspan="3" style="text-align: center; letter-spacing: 1px; padding-left: 0px;">Thao Tác</th>
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
                                            <td class="d-none d-xl-table-cell">{{ $item->birthDate }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $item->id_card }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $item->health_card }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $item->phone }}</td>

                                            <td class="d-none d-md-table-cell d-user-2" data="@php
                                                echo 'confirm-' . $item->id_card;
                                            @endphp">
                                                <i class="fas fa-check" style="color: #3b7ddd;"></i>
                                                {{-- <a href="{{ url('vaccine/done-patient', ['id' => $item->id]) }}"
                                                    onclick="return confirm('CHUYỂN VÀO DANH SÁCH CHỜ')">
                                                    <i class="fas fa-check"></i>
                                                </a> --}}
                                            </td>
                                            <td class="d-none d-md-table-cell" id="delete[{{ $item->id_card }}]">
                                                <a href="{{ url('vaccine/delete-patient', ['id' => $item->id_card]) }}"
                                                    onclick="return confirm('XÓA KHỎI DANH SÁCH HÔM NAY')">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </td>
                                            <td class="d-none d-md-table-cell d-user" data="{{ $item->id_card }}">
                                                <i class="far fa-user" style="color: #3b7ddd;"></i>
                                            </td>
                                        
                                        </tr>



                                        <div class="col-md-6 info-patient d-none" id="{{ $item->id_card }}">
                                            <form action="">
                                                <h3>ThÔNG TIN BỆNH NHÂN</h3>

                                                <div class="info">
                                                    <div class="mb d-flex">
                                                        <label for="" class='form-label'>{{ $item->fullname }}</label>
                                                        <input type="text" class='form-control w-50'
                                                            value="{{ $item->fullname }}">
                                                    </div>
                                                    <div class="mb d-flex">
                                                        <label for="" class='form-label'>Ngày Sinh</label>
                                                        <input type="text" class='form-control w-50'
                                                            value="@php
                                                                echo date('d-m-Y', strtotime($item->birthday));
                                                            @endphp">
                                                    </div>
                                                    <div class="mb d-flex">
                                                        <label for="" class='form-label'>CMND/CCCD</label>
                                                        <input type="text" class='form-control w-50'
                                                            value="{{ $item->id_card }}">
                                                    </div>
                                                    <div class="mb d-flex">
                                                        <label for="" class='form-label'>Số Thẻ BHYT</label>
                                                        <input type="text" class='form-control w-50'
                                                            value="{{ $item->health_card }}">
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
                                                            value="{{ $item->address }}-{{ $item->ward }}-{{ $item->district }}-{{ $item->city }}">
                                                    </div>
                                                    <div class="mb d-flex">
                                                        <label for="" class='form-label'>Lần tiêm</label>
                                                        <input type="text" class='form-control w-50'
                                                            value="{{ $item->injection_times }}">
                                                    </div>
                                                    {{-- <div class="mb d-flex">
                                                        <label for="" class='form-label'>Tên Vaccine</label>
                                                        <input type="text" class='form-control w-50'
                                                            value="{{ $item->name }}">
                                                    </div> --}}
                                                </div>

                                                <div class="mb-3 d-flex mb-submit justify-content-end mt-3">
                                                    <span class="btn btn-primary btn-d-none"
                                                        data='{{ $item->id_card }}'>Xác Nhận</span>
                                                    {{-- <a href="{{ url()->current() }}" class="btn btn-primary">Xác Nhận</a> --}}
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
                        @if ($vaccines)
                        @foreach ($vaccines as $item)
                        <div class="col-md-6 info-patient d-none" id="@php echo 'confirm-' . $item->id_card;
                            @endphp">
                               <form
                                   action="{{ url('vaccine/confirm-vaccine', ['id_card' => $item->id_card]) }}"
                                   method="post">
                                   @csrf
                                   <div class="mb d-flex">
                                       <label for=""
                                           class='form-label'>Tên bệnh nhân</label>
                                       <input type="text" class='form-control w-50'
                                           value="{{ $item->fullname }}">
                                   </div>
                                   <div class="mb d-flex">
                                       <label for="" class='form-label'>CMND/CCCD</label>
                                       <input type="text" class='form-control w-50'
                                           value="{{ $item->health_card }}">
                                   </div>
                                   <div class="mb d-flex">
                                       <label for="" class='form-label'>Lần tiêm</label>
                                       <input type="text" class='form-control w-50'
                                           value="{{ $item->injection_times }}">
                                   </div>

                                   @if ($item->injection_times > 1)
                                       <div class="mb d-flex">
                                           <label for="" class='form-label'>vắc xin tiêm lần 1</label>
                                           <input type="text" class='form-control w-50'
                                               value="{{ $item->vaccine_1 }}">
                                       </div>
                                   @endif
                                   @if ($item->injection_times > 2)
                                       <div class="mb d-flex">
                                           <label for="" class='form-label'>vắc xin tiêm lần 2</label>
                                           <input type="text" class='form-control w-50'
                                               value="{{ $item->vaccine_2 }}">
                                       </div>
                                   @endif
                                   <div class="mb d-flex">
                                    <label for=""
                                        class='form-label'>Loại Bệnh</label>
                                    <input type="text" class='form-control w-50'
                                        value="@php
                                        
                                        if($item->id_disease){
                                            echo DB::table('diseases')->where('id',$item->id_disease)->first()->name;
                                        }
                                        @endphp">
                                </div>

                                   <div class="mb d-flex mt-4">
                                       <label for="select_vac" class='form-label'
                                           style=" font-weight: 600; font-size: 1.2rem; text-transform: uppercase; margin-left: 15%; text-decoration: underline;">
                                           Chọn Vắc Xin
                                       </label>
                                       <select class="form-select w-50"
                                           style="border: 3px solid #f08484;" name="select_vac"
                                           id="select_vac">
                                           @foreach ($list_vac as $name_vac)
                                               <option @php
                                                   if ($name_vac['name'] == $item->vaccine_1) {
                                                       echo 'selected';
                                                   }
                                               @endphp value="{{ $name_vac['name'] }}">
                                                   {{ $name_vac['name'] }} - <span style="color: rgb(245, 35, 35);">{{$name_vac['quantity']}}</span></option>
                                           @endforeach
                                       </select>
                                   </div>
                                   <div class="d-flex justify-content-center mt-4">
                                       <div class="mb d-flex justify-content-evenly w-50">
                                           <button type="submit" class="btn btn-primary"
                                               style="width: 40%; height: 40px;">
                                               XÁC NHẬN
                                           </button>
                                           <span class="btn btn-outline-secondary btn-d-none"
                                               style="width: 40%; height: 40px; display: flex; align-items: center; justify-content: center;"
                                               data='@php
                                                   echo 'confirm-' . $item->id_card;
                                               @endphp'>QUAY LẠI</span>
                                       </div>
                                   </div>

                               </form>
                           </div>
                        @endforeach
                        @endif
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
    </div>

@endsection
