@extends('adminlte::page')

@section('content_header')
    <h1>Quản lý nhân viên</h1>
    {{ Breadcrumbs::render('staffs') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Quản lý nhân viên</h3>
                    <a class="btn btn-primary pull-right" title="Thêm mới" href="{{ route('staffs.export') }}">
                        <i class="fa fa-fw fa-download"></i>
                        Xuất file xlsx
                    </a>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped text-center">
                        <tbody>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Mã nhân viên</th>
                                <th>Vai trò</th>
                                <th>Chi tiết</th>
                            </tr>
                            @foreach ($staffs as $staff)
                                <tr>
                                    <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                                    <td style="vertical-align: middle;">{{ $staff->name }}</td>
                                    <td style="vertical-align: middle;">{{ $staff->user->email }}</td>
                                    <td style="vertical-align: middle;">{{ $staff->id }}</td>
                                    <td style="vertical-align: middle;">{{ $staff->user->role }}</td>
                                    <td>
                                        <a class="btn" title="Chi tiết" href="{{ route('staffs.show', $staff->id) }}">
                                            <i class="fa fa-fw fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
