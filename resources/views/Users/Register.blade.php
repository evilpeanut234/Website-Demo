@extends('layouts.default')
@section ('title','Đăng kí')
@section ('sidebar')
@parent

@endsection
@section ('content')
<div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white">
        <h3 style="text-align: center">Đăng ký</h3>
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
        <form action="Register" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="username">Tên đăng nhập</label>
                <input type="text" name="username" <?php if (isset($username)) echo 'value = "' . $username . '"' ?> class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            <div class="row">
                <div class="col-12-md col-6">
                    <div class="form-group">
                        <label for="pwd">Mật khẩu</label>
                        <input type="password" name="pwd" class="form-control" placeholder="" aria-describedby="helpId">
                    </div>
                </div>
                <div class="col-12-md col-6">
                    <div class="form-group">
                        <label for="pwd_confirm">Nhập lại mật khẩu</label>
                        <input type="password" name="pwd_confirm" class="form-control" placeholder="" aria-describedby="helpId">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <button type="submit" class="btn btn-primary">Đăng kí</button>
                    </div>
                    <div class="col-12 col-sm-8 text-right">
                        <a class="text-info" href="./login"><span>Đã có tài khoản</span></a>
                    </div>
                </div>
            </div>
            @if($errors->any())

        {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
        @endif
        </form>
    </div>
</div>
@endsection
