@extends('layouts.master')
@section('title','Topup Mobile')
@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">
        Topup Mobile
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{ route('topup_mobile') }}" class="card">
                @csrf
                <input type="hidden" name="type" value="{{ $type }}">                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-lg-4"></div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label class="form-label">Nhà mạng <span class="form-required">*</span></label>
                                <select class="form-control custom-select {!! $errors->first('telco','is-invalid') !!}" name="telco">
                                    <option value="">Chọn nhà mạng</option>
                                    @foreach($listTelco as $telco)
                                    <option value="{{ $telco->id }}" {{ (old('telco') == $telco->id) ? 'selected' : ''}}>{{ $telco->name }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('telco','<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                <label class="form-label">Mệnh giá <span class="form-required">*</span></label>
                                @if($type == 1)
                                <select class="form-control custom-select {!! $errors->first('amount','is-invalid') !!}" name="amount">
                                    <option value="">Chọn mệnh giá</option>   
                                    @foreach($arrAmount as $amount)
                                    <option value="{{ $amount }}" {{ (old('amount') == $amount) ? 'selected' : ''}}>{{ number_format($amount) }}</option>
                                    @endforeach                                 
                                </select>
                                @elseif($type == 2)
                                <input type="text" class="form-control {!! $errors->first('amount','is-invalid') !!}" name="amount" placeholder="Mệnh giá" value="{{ old('amount')}}">
                                @endif
                                
                                {!! $errors->first('amount','<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                <label class="form-label">Số điện thoại nạp <span class="form-required">*</span></label>
                                <input type="text" class="form-control {!! $errors->first('mobile','is-invalid') !!}" name="mobile" placeholder="Số điện thoại nạp" value="{{ old('mobile')}}">
                                {!! $errors->first('mobile','<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="btn-list">
                                <button type="submit" class="btn btn-primary">Nạp</button>
                                <a class="btn btn-secondary" href="{{ route('topup_list') }}">Bỏ qua</a>
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