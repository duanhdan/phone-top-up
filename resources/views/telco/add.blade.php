@extends('layouts.master')
@section('title','Thêm mới Telco')
@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">
        Thêm mới Telco
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{ route('telco_add') }}" class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-lg-4"></div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label class="form-label">Tên Telco <span class="form-required">*</span></label>
                                <input type="text" class="form-control {!! $errors->first('name','is-invalid') !!}" name="name" placeholder="Tên Telco" value="{{ old('name')}}">
                                {!! $errors->first('name','<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                <label class="form-label">Mã Telco <span class="form-required">*</span></label>
                                <input type="text" class="form-control {!! $errors->first('code','is-invalid') !!}" name="code" placeholder="Mã Telco" value="{{ old('code')}}">
                                {!! $errors->first('code','<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="btn-list">
                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                                <a class="btn btn-secondary" href="{{ route('telco_list') }}">Bỏ qua</a>
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