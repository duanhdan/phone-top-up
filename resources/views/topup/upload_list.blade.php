@extends('layouts.master')
@section('title','Danh sách đơn Topup')
@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">
        Danh sách đơn Topup
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="GET" action="{{ route('topup_upload_list') }}" class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="from_date" placeholder="Từ ngày" value="{{ isset($filter['from_date']) ? $filter['from_date'] : '' }}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="to_date" placeholder="Đến ngày" value="{{ isset($filter['to_date']) ? $filter['to_date'] : '' }}">
                        </div>
                        <div class="col-md-3">
                            <select name="type" class="form-control custom-select">
                                <option value="">Loại đơn</option>
                                <option value="1" {{ (isset($filter['type']) && $filter['type'] == 1) ? 'selected' : ''}}>Thông thường</option>
                                <option value="2" {{ (isset($filter['type']) && $filter['type'] == 2) ? 'selected' : ''}}>Khẩn cấp</option>                              
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Lọc</button>
                            <a class="btn btn-outline-primary" href="{{ route('topup_upload_list') }}"><i class="fa fa-close"></i> Bỏ lọc</a>
                        </div>
                    </div>
                </div>
                <div class="card-header">
                    <a class="btn btn-outline-primary" href="{{ route('topup_upload') }}"><i class="fe fe-plus mr-2"></i>Tạo đơn Topup</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-bordered table-hover" >
                            <thead>
                                <tr align="center">
                                    <th width="5%">#</th>
                                    <th>File</th>
                                    <th>Danh sách nạp</th>
                                    <th>Loại đơn</th>
                                    <th>Chiết khấu</th>
                                    <th>Tổng tiền (VNĐ)</th>
                                    <th>Thời gian nạp</th>
                                <tr>
                            </thead>
                            <tbody align="center">
                                @foreach($listUpload as $key =>  $upload)
                                <tr>
                                    <td>{{ $key + 1}}</td>
                                    <td><a href="{{$upload->file}}">{{$upload->file}}</a></td>
                                    <td><a href="{{ route('topup_list') }}?upload_id={{$upload->id}}">Xem</a></td>
                                    <td>{{ ($upload->type == 1) ? 'Thông thường' : 'Khẩn cấp' }}</td>
                                    <td>{{ $upload->discount }}%</td>
                                    <td>{{ number_format($upload->total_price) }}</td>
                                    <td>{{$upload->created_at}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td>Tổng</td>
                                    <td colspan="6">{{ number_format($totalAmount) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="box-footer clearfix">

                            <ul class="pagination">
                                {{ $listUpload->appends($filter)->onEachSide(1)->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop