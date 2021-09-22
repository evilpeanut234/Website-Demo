@extends('layouts.default')
@section ('title','Đăng nhập')
@section ('sidebar')
@parent

@endsection
@section ('content')
<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white">
    <h3 style="text-align: center">Quên mật khẩu</h3>
    <hr>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('status') }}
    </div>
    @elseif(session('failed'))
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('failed') }}
    </div>
    @endif
    <form action="Forgot" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="email">Nhập email đã đăng ký tài khoản</label>
            <input type="text" name="email" class="form-control" placeholder="" aria-describedby="helpId">
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-12 col-sm-4">
                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                </div>
            </div>
        </div>
    </form>
    @if($errors->any())
        {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
    @endif
</div>
@endsection