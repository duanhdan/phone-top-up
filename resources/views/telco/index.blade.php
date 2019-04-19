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
                    <a class="btn btn-outline-primary" href="{{ route('telco_add') }}"><i class="fe fe-plus mr-2"></i>Thêm mới</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-bordered table-hover" >
                            <thead>
                                <tr align="center">
                                    <th width="5%">#</th>
                                    <th>Telco</th>
                                    <th>Code</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                    <th width="10%">Thao tác</th>
                                <tr>
                            </thead>
                            <tbody align="center">
                                @foreach($listTelco as $key =>  $telco)
                                <tr>
                                    <td>{{ $key + 1}}</td>
                                    <td>{{ $telco->name }}</td>
                                    <td>{{ $telco->code }}</td>
                                    <td>{!! ($telco->status == 1) ? '<i class="fe fe-check-circle" style="color:#398439;" data-toggle="tooltip" data-original-title="Hoạt động"></i>': '<i class="fe fe-x-circle" data-toggle="tooltip" style="color:#dd4b39" data-original-title="Không hoạt động"></i>'!!}
                                    </td>
                                    <td>{{ $telco->created_at }}</td>
                                    <td>
                                        <a href="{{ route('telco_edit',$telco->id)}}" class="mr-2"><i class="fe fe-edit" data-toggle="tooltip" data-original-title="Sửa"></i></a> | 
                                        <a href="javascript:;" class="ml-2 ajax_action" data-id="{{$telco->id}}" data-method="POST" data-action="{{route('telco_delete')}}" data-label="Xóa Telco"><i class="fe fe-trash-2" style="color:#dd4b39" data-toggle="tooltip" data-original-title="Xóa"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop