@extends('layouts.admin')
@section('content')
    <div class="content">
        <div id="content" class="container-fluid">
            @if (session('status'))
                    <div class="alert alert-success" style="margin-bottom: 1px">{{ session('status') }}</div>
                @endif
                @if (session('delete'))
                    <div class="alert alert-success" style="margin-bottom: 1px">Đã xóa <b>{{ session('delete') }}</b> thành công !!!</div>
                @endif
                @if (session('restore'))
                    <div class="alert alert-success" style="margin-bottom: 1px">Khôi phục <b>{{ session('restore') }}</b> thành công !!!</div>
                @endif
            <div class="card position-relative" style="top: 1px">
                <div class="card-header d-flex justify-content-between" >
                    <div class="card-header-left">
                        <span class="font-weight-bold" style="font-size: 1.8rem; text-transform: uppercase;">Danh Sách Bệnh Viện Đã Xóa</span>
                        {{-- <div class="header-count">
                            <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}" class="header-count-link a1">Tài
                                khoản được kích hoạt({{ $count['active'] }})</a>
                            <a href="{{ request()->fullUrlWithQuery(['status' => 'disable']) }}" class="header-count-link a2">Tài
                                khoản bị vô hiệu hóa({{ $count['disable'] }})</a>
                        </div> --}}
                    </div>
                    <form class="form-inline">
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" class="form-control" id="inputPassword2" name="keyword"
                                value="{{ request()->input('keyword') }}" placeholder="Search ...">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2" name="submit">Tìm Kiếm</button>
                    </form>
                </div>
                {!! Form::open(['url' => 'users/option']) !!}
    
                {{-- <div class="select-option" style="display: flex;">
                    <select name="act" class="form-control col-md-2" style="margin-right: 10px;">
                        <option>Chọn</option>
                        @foreach ($hospitals_act as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                    <input type="submit" class="btn btn-primary" name="option" value="Áp dụng">
                </div> --}}
                {{-- script --}}
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên Bệnh Viện</th>
                                <th scope="col">Địa Chỉ</th>
                                <th scope="col">Email</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($hospitals->count() > 0)
                                @php
                                    $count = 1;
                                @endphp
                                @foreach ($hospitals as $item)
    
                                    <tr>
                                        <th scope="row">{{ $count }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->address}}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <a href="{{ url('admin/hospital-acc/restore/' . $item->id_user) }}"
                                                class="btn btn-success btn-sm rounded-0 text-white"
                                                type="button"
                                                onclick="return confirm('Khôi phục tài khoản?')"><i
                                                data-toggle="tooltip" data-placement="top" title="Khôi Phục" name="edit">
                                                <i class="far fa-window-restore"></i>
                                            </a>
                                            <a href="{{ url('admin/hospital-acc/delete-bin/' . $item->id_user) }}"
                                                class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                title="Xóa Vĩnh Viễn"
                                                onclick="return confirm('Xóa vĩnh viễn?')"><i
                                                    class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @php
                                        $count++;
                                    @endphp
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">Không tìm thấy bản ghi nào</td>
                                </tr>
    
                            @endif
    
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        {{ $hospitals->links() }}
                    </nav>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
