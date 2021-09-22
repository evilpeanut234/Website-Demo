<!doctype html>
<html lang="en">

<head>
    <title>Kích hoạt tài khoản</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
</head>

<body>


    <!--modal-->
    <h1 style="
    text-align: center;">
        Chào mừng bạn đến với trang thương mại điện tử
    </h1>
    @if(isset($details['username']))

    <div>

        <p style="
    text-align: center;
    font-size: 120%;">
    Vui lòng click vào đường button bên dưới để kích hoạt tài khoản</p>
        <div style="
    text-align: center;
    width: 280px;
    margin: auto;">
            <fieldset style="
                                padding: 15px 25px;
                                background: #337AB7;
                                border: none;
                                border-radius: 10px;">

                <a href="{{$details['link']}}" style="width: 100%;text-align: center;font-size: 20px;/* padding: 20px; */color: #fff;text-decoration: none;">
                Kích hoạt tài khoản</a>
            </fieldset>
        </div>
    </div>
    @endif

    @if(isset($details['reset']))

    <div>

        <p style="
    text-align: center;
    font-size: 120%;">
    Vui lòng click vào đường button bên dưới để thiết lập lại mật khẩu/p>
        <div style="
    text-align: center;
    width: 280px;
    margin: auto;">
            <fieldset style="
                                padding: 15px 25px;
                                background: #337AB7;
                                border: none;
                                border-radius: 10px;">

                <a href="{{$details['link']}}" style="width: 100%;text-align: center;font-size: 20px;/* padding: 20px; */color: #fff;text-decoration: none;">
                Kích hoạt tài khoản</a>
            </fieldset>
        </div>
    </div>
    @endif
</body>

</html>
