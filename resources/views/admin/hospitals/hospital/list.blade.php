@extends('layouts.admin')
@section('content')
    <div class="content">
        @if (session('email'))
        <div class="alert alert-success" style="margin-bottom: 1px">{{ session('email') }}</div>
    @endif
        @if (session('status'))
        <div class="alert alert-success" style="margin-bottom: 1px">{{ session('status') }}</div>
    @endif
    @if (session('delete'))
        <div class="alert alert-success" style="margin-bottom: 1px">Xóa <b>{{ session('delete') }}</b> thành
            công !!!</div>
    @endif
    @if (session('update'))
        <div class="alert alert-success" style="margin-bottom: 1px">Cập Nhật <b>{{ session('update') }}</b>
            thành công !!!</div>
    @endif
        <div id="content">
            
            <div class="card position-relative" style="top: 1px ">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-header-left">
                        <span class="font-weight-bold" style="font-size: 1.8rem; text-transform: uppercase;">Danh Sách Bệnh
                            Viện</span>

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
                
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên Bệnh Viện</th>
                                <th scope="col">Địa Chỉ</th>
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
                                        <td>{{ $item->address.'-'.$item->ward.'-'.$item->province.'-'.$item->city }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                        <td>
                                            <a href="{{ url('admin/hospital/edit/'.$item->id) }}"
                                                class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                data-toggle="tooltip" data-placement="top" title="chỉnh sửa" name="edit">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            @if (Auth::id() != $item->id)
                                                <a href="{{ url('admin/hospital/delete/'.$item->id) }}"
                                                    class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                    title="Xóa Thùng Rác"
                                                    onclick="return confirm('Xóa tài khoản này không?')"><i
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
    </div>
@endsection
