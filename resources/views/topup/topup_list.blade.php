@extends('layouts.master')
@section('title','Danh sách Topup')
@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">
        Danh sách Topup
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="GET" action="{{ route('topup_list') }}" class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2 col-sm-6">
                            <input type="text" class="form-control" name="from_date" placeholder="Từ ngày" value="{{ isset($filter['from_date']) ? $filter['from_date'] : '' }}">
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <input type="text" class="form-control" name="to_date" placeholder="Đến ngày" value="{{ isset($filter['to_date']) ? $filter['to_date'] : '' }}">
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <input type="text" class="form-control" name="mobile" placeholder="Số điện thoại" value="{{ isset($filter['mobile']) ? $filter['mobile'] : '' }}">
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <select name="telco" class="form-control custom-select">
                                <option value="">Nhà mạng</option>
                                @foreach($listTelco as $telco)
                                <option value="{{ $telco['id'] }}" {{ (isset($filter['telco']) && $filter['telco'] == $telco['id']) ? 'selected' : ''}}>{{ $telco['name'] }}</option>
                                @endforeach                     
                            </select>
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <select name="status" class="form-control custom-select">
                                <option value="">Trạng thái</option>
                                <option value="1" {{ (isset($filter['status']) && $filter['status'] == 1) ? 'selected' : ''}}>Thành công</option>
                                <option value="2" {{ (isset($filter['status']) && $filter['status'] == 2) ? 'selected' : ''}}>Không thành công</option>  
                                <option value="0" {{ (isset($filter['status']) && $filter['status'] == 0) ? 'selected' : ''}}>Đang xử lý</option>                 
                            </select>
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Lọc</button>
                            <a class="btn btn-outline-primary" href="{{ route('topup_list') }}"><i class="fa fa-close"></i> Bỏ lọc</a>
                        </div>
                    </div>
                </div>
                <div class="card-header">
                    <a class="btn btn-outline-primary" href="{{ route('topup_tra_truoc') }}"><i class="fe fe-plus mr-2"></i>Tạo Topup Mobile</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-bordered table-hover" >
                            <thead>
                                <tr align="center">
                                    <th width="5%">#</th>
                                    <th>Số điện thoại nạp</th>
                                    <th>Nhà mạng</th>
                                    <th>Hình thức</th>
                                    <th>Mệnh giá (VND)</th>
                                    <th>Trạng thái</th>
                                    <th>Thời gian nạp</th>
                                    <th>Đại lý nạp</th>
                                <tr>
                            </thead>
                            <tbody align="center">
                                @foreach($listTopup as $key =>  $topup)
                                <tr>
                                    <td>{{ $key + 1}}</td>
                                    <td>{{ $topup->mobile }}</td>
                                    <td>{{ $listTelco[$topup->telco_id]['name'] }}</td>
                                    <td>{{ ($topup->type == 1) ? 'Trả trước' : 'Trả sau' }}</td>
                                    <td>{{ number_format($topup->amount) }}</td>
                                    <td>{{ ($topup->status == 2) ? $topup->result : $status[$topup->status] }}</td>
                                    <td>{{$topup->created_at}}</td>
                                    <td>{{$listUser[$topup->user_id]['name']}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td>Tổng</td>
                                    <td colspan="7">{{ number_format($totalAmount) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="box-footer clearfix">

                            <ul class="pagination">
                                {{ $listTopup->appends($filter)->onEachSide(1)->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop