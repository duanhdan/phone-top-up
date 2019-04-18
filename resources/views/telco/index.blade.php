@extends('layouts.master')
@section('title','Danh sách Telco')
@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">
        Danh sách Telco
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="GET" action="{{ route('telco_list') }}" class="card">
                <div class="card-header">
                    <a class="btn btn-outline-primary" href="{{ route('telco_add') }}"><i class="fe fe-plus"></i> Thêm mới</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Telco</th>
                                    <th>Code</th>
                                    <th>Trạng thái</th>
                                    <th width="20%">Thao tác</th>
                                <tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Viettel</td>
                                    <td>VT</td>
                                    <td>Hoạt động</td>
                                    <th>Sửa | Xóa | Khóa</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Viettel</td>
                                    <td>VT</td>
                                    <td>Hoạt động</td>
                                    <th>Sửa | Xóa | Khóa</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Viettel</td>
                                    <td>VT</td>
                                    <td>Hoạt động</td>
                                    <th>Sửa | Xóa | Khóa</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop