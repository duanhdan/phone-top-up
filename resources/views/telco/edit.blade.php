@extends('backend::layouts.master')
@section('title','Cập nhật thành viên')

@section('header')
<!-- iCheck -->
<link rel="stylesheet" href="/static/backend/plugins/iCheck/square/blue.css">
@stop
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Cập nhật thành viên
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('users_list')}}">Thành viên</a></li>
        <li class="active">Cập nhật</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <form role="form" method="POST" action="{{ route('users_edit',$user->id) }}">
            @csrf
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin thành viên</h3>
                </div>
                
                <div class="box-body">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="form-group {!! $errors->first('name','has-error') !!}">
                            <label for="exampleInputName">Họ tên</label>
                            <input type="text" class="form-control" name="name" value="{{ !empty(old('name')) ? old('name') : $user->name}}" placeholder="Họ tên">
                            {!! $errors->first('name','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group {!! $errors->first('email','has-error') !!}">
                            <label for="exampleInputEmail">Email</label>
                            <input disabled="true" type="text" class="form-control" name="email" value="{{ !empty(old('email')) ? old('email') : $user->email}}" placeholder="Email">
                            {!! $errors->first('email','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group {!! $errors->first('phone','has-error') !!}">
                            <label for="exampleInputEmail">Số điện thoại</label>
                            <input type="text" class="form-control" name="phone" value="{{ !empty(old('phone')) ? old('phone') : $user->phone}}" placeholder="Số điện thoại">
                            {!! $errors->first('phone','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group {!! $errors->first('address','has-error') !!}">
                            <label for="exampleInputEmail">Địa chỉ</label>
                            <input type="text" class="form-control" name="address" value="{{ !empty(old('address')) ? old('address') : $user->address}}" placeholder="Địa chỉ">
                            {!! $errors->first('address','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group {!! $errors->first('gender','has-error') !!}">
                            <label>Giới tính</label>
                            <select class="form-control" name="gender">
                                <option value="0">Giới tính</option>
                                <option value="1" {{ ($user->gender == 1 ) ? 'selected':''}}>Nam</option>
                                <option value="2" {{ ($user->gender == 2 ) ? 'selected':''}}>Nữ</option>
                            </select>
                            {!! $errors->first('gender','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group {!! $errors->first('status','has-error') !!}">
                            <label><input type="checkbox" name="status" value="1" class="form-control" {{ ($user->status == 1) ? 'checked' : '' }}> Kích hoạt</label>
                            {!! $errors->first('status','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group {!! $errors->first('password','has-error') !!}">
                            <label for="exampleInputPassword">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" value="" placeholder="Mật khẩu">
                            {!! $errors->first('password','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group {!! $errors->first('confirm_password','has-error') !!}">
                            <label for="exampleInputPassword">Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" name="confirm_password" value="" placeholder="Nhập lại mật khẩu">
                            {!! $errors->first('confirm_password','<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {!! $errors->first('role_id','has-error') !!}">
                            <label>Nhóm phân quyền</label>
                            <select class="form-control" name="role_id">
                                <option value="0">Chọn nhóm phân quyền</option>
                                @foreach($arrRole as $role)
                                <option value="{{ $role->id }}" {{ ($user->role_id == $role->id ) ? 'selected':''}}> {{ $role->name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('role_id','<span class="help-block">:message</span>') !!}
                        </div>
                        @can('users.add')
                            <button type="submit" class="btn btn-primary margin">
                                Cập nhật
                            </button>
                            <a type="submit" class="btn btn-default" href="{{ route('users_list') }}">
                                Bỏ qua
                            </a>
                        @endcan
                    </div>
                    <div class="col-md-4"></div>
                </div>
                
            </div>
            
            </form>
        </div>
    </div>

</section>
<!-- /.content -->
@stop

@section('script')
<!-- iCheck -->
<script src="/static/backend/plugins/iCheck/icheck.min.js"></script>

<script>
    $(function () {
        $('input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>
@stop