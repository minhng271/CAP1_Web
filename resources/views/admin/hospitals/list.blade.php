@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card position-relative">
            @if (session('status'))
                <span class="alert alert-success">{{ session('status') }}</span>
            @endif
            @if (session('delete'))
                <span  class="alert alert-success">Xóa <b>{{ session('delete') }}</b> thành công !!!</span>
            @endif
            @if (session('update'))
            <span class="alert alert-success">Cập Nhật <b>{{ session('update') }}</b> thành công !!!</span>
        @endif
            <div class="card-header d-flex justify-content-between">
                <div class="card-header-left">
                    <span class="font-weight-bold" style="font-size: 1.8rem; text-transform: uppercase;">Danh Sách Bệnh Viện</span>
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
            <script>
                $(document).ready(function() {
                    $("#ckeck-all").click(function() {
                        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
                    });
                });
            </script>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td><input type="checkbox" name="check-all" value="" id="ckeck-all"></td>
                            <th scope="col">#</th>
                            <th scope="col">Tên Bệnh Viện</th>
                            <th scope="col">SDT</th>
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
                                    <td><input type="checkbox" name="check[]" value="{{ $item->id }}"
                                            class="check"></td>
                                    <th scope="row">{{ $count }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ date('d-m-Y',strtotime($item->created_at)) }}</td>
                                    <td>
                                        <a href="{{ url('admin/hospital/edit/' . $item->id) }}"
                                            class="btn btn-success btn-sm rounded-0 text-white"
                                            type="button"
                                            data-toggle="tooltip" data-placement="top" title="chỉnh sửa" name="edit">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        @if (Auth::id() != $item->id)
                                            <a href="{{ url('admin/hospital/delete/' . $item->id) }}"
                                                class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                title="Xóa Thùng Rác"
                                                onclick="return confirm('Bạn chắc chắn muốn xóa vĩnh viễn không?')"><i
                                                    class="fa fa-trash"></i></a>
                                        @endif
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
@endsection
