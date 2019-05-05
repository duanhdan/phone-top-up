@extends('layouts.master')
@section('title','Topup thành công')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <form class="card">
                <div class="card-header">
                    <h2>Kết quả giao dịch nạp</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-lg-4"></div>
                        <div class="col-md-4 col-lg-4">
                            <table>
                                <tr>
                                    <td>Mệnh giá</td>
                                    <td>{{ number_format($amount) }}</td>
                                </tr>
                                <tr>
                                    <td>Thuê bao</td>
                                    <td>{{ $mobile }}</td>
                                </tr>
                                <tr>
                                    <td>Nhà mạng</td>
                                    <td>{{ $telco->name }}</td>
                                </tr>
                                <tr>
                                    <td>Thời gian</td>
                                    <td>{{ date('d/m/Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <td>Trạng thái</td>
                                    <td>Đang xử lý</td>
                                </tr>
                            </table>
                            <div class="btn-list">
                                <a class="btn btn-primary" href="{{ route('topup_tra_truoc') }}">Nạp tiếp</a>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop