@extends('layouts.default')
@section ('title','Đăng nhập')
@section ('sidebar')
@parent

@endsection
@section ('content')
<div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white">
        <h3 style="text-align: center">Đăng nhập</h3>

        @if (session('status'))
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('status') }}
        </div>
        @endif
        <form action="login" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="username">Tên đăng nhập hoặc email</label>
                <input type="text" name="username" <?php if (isset($username)) echo 'value = "' . $username . '"' ?> class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            <div class="row">
                <div class="col-12-md col-12">
                    <div class="form-group">
                        <label for="pwd">Mật khẩu</label>
                        <input type="password" name="pwd" class="form-control" placeholder="" aria-describedby="helpId">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <button type="submit" class="btn btn-primary">Đăng nhập</button>
                    </div>
                </div>
            </div>
            <p>Nếu bạn chưa có tài khoản, đăng ký <a href="Register">tại đây</a>.</p>
            @if($errors->any())

        {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
        @endif
        </form>

    </div>
</div>
@endsection
