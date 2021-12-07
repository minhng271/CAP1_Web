@extends('layouts.vaccine')
@section('content')
    <div class="content">
        <div class="card-header  d-flex justify-content-between">
            <h3 style="text-transform: uppercase; font-weight: 600;">Thay đổi lựa chọn vắc xin cho loại bệnh</h3>
            
        </div>
        <div class="card flex-fill">
            <div class="container">
                <div class="row d-flex justify-content-center" style=" box-sizing: border-box; padding: 30px; background: #fff; border-radius: 8px; ">
                    <div class="col-md-10">
                        <form method="POST" action="{{ url('vaccine/store-edit-disease', ['id'=>$id]) }}" >
                            @csrf
                            <div class="row">
                                <div class="col-md-6 d-flex flex-row">
                                    <span style=" font-size: 3rem; font-weight: 600; text-transform: uppercase; ">{{$name}}</span>
                                </div>
                                <div class="col-md-6" style="background: white; height: 400px;overflow: auto;border: 1px solid;border-radius: 8px;box-sizing: border-box;padding: 15px;">
                                    @foreach ($list_vac_all as $vac_all_item)
                                        <div class="d-flex ml-4">
                                            <input class="form-check-input" type="checkbox" 
                                        @php
                                            foreach ($list_vac as $item) {
                                                if($item['name'] == $vac_all_item['name']){
                                                    echo "checked";
                                                    break;
                                                }
                                                
                                            }
                                        @endphp
                                        id="{{$vac_all_item['id']}}" style=" font-size: 1.7rem; "
                                        name="vaccine[{{$vac_all_item['id']}}]" value="{{$vac_all_item['id']}}">
                                        
                                        <label style=" font-size: 1.8rem; margin-left: 20px; " class="form-check-label" for="{{$vac_all_item['name']}}">{{$vac_all_item['name']}}</label>
                                        
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6" style=" padding: 0px; margin-top: 15px; ">
                                    <button type="submit" value="" name="submit" class="btn btn-primary">Xác nhận</button>
                                    <a href="{{ url('vaccine/danh-sach-loai-benh', []) }}" class="btn btn-outline-secondary">Hủy Bỏ</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection