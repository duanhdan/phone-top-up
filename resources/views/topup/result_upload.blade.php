@extends('layouts.master')
@section('title','Upload thành công')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <form class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-lg-4"></div>
                        <div class="col-md-4 col-lg-4">
                            <table>
                                <tr>
                                    <td>Loại đơn</td>
                                    <td>{{ ($type == 1) ? 'Thông thường' : 'Khẩn cấp'}}</td>
                                </tr>
                                <tr>
                                    <td>Chiết khấu</td>
                                    <td>{{ ($type == 1) ? '25%' : '28%'}}</td>
                                </tr>
                                <tr>
                                    <td>Số thuê bao</td>
                                    <td>{{ number_format($count) }}</td>
                                </tr>
                                <tr>
                                    <td>Tổng mệnh giá</td>
                                    <td>{{ number_format($total) }}</td>
                                </tr>
                                <tr>
                                    <td>Tên file</td>
                                    <td><a href="{{ $file_path }}">{{ $filename }}</a></td>
                                </tr>
                            </table>
                            <div class="btn-list">
                                <a class="btn btn-primary" href="{{ route('topup_upload') }}">Quay lại</a>
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