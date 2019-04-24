@extends('layouts.master')
@section('title','Upload đơn hàng')
@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">
        Upload đơn hàng
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{ route('topup_upload') }}" class="card" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-lg-4"></div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label class="form-label">Loại đơn</label>
                                <select class="form-control custom-select {!! $errors->first('type','is-invalid') !!}" name="type">
                                    <option value="">Chọn loại đơn</option>
                                    <option value="1">Thông thường</option>
                                    <option value="2">Khẩn cấp</option>
                                </select>
                                {!! $errors->first('type','<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                <label class="form-label">CK loại đơn (%)</label>
                                <input type="text" class="form-control" readonly="true" placeholder="CK loại đơn (%)" value="">
                            </div>
                            <div class="form-group">
                                <div class="form-label">File</div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input {!! $errors->first('file','is-invalid') !!}" name="file">
                                    <label class="custom-file-label">Chọn file</label>
                                    {!! $errors->first('file','<div class="invalid-feedback">:message</div>') !!}
                                </div>                                
                            </div>
                            <div class="form-group">
                                <a href="/upload/example.xlsx">File mẫu</a>
                            </div>
                            <div class="btn-list">
                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                                <a class="btn btn-secondary" href="{{ route('topup_upload_list') }}">Bỏ qua</a>
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