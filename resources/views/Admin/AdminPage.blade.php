<html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <link rel="stylesheet" type="text/css" href="{{ url('/style/main.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/style/Admin/adminStyle.css') }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/28e407cbaa.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

    <!--#region Datepicker libary -->

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <!--#endregion -->

    {{-- <script src="{{ url('/js/jquery.table2excel.js') }}"></script>
    --}}
    {{-- Excel --}}
    <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
    {{-- End Excel --}}
    <!-- nhan -->

    <title>@yield('title')</title>
    <link rel="icon" href="{{ url('/image/icon/icon.ico') }}" type="image/x-icon">
</head>


<body>
    <!--wrapper start-->
    <div class="wrapper">
        <!--header menu start-->
        <div class="header">
            <div class="header-menu">
                <div class="sidebar-btn">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="title">ADMIN <span>DASHBROAD</span></div>

                <ul class="manipulation">
                    <li><a href="{{ URL::to('/') }}"><i class="fas icon-nav fa-house-user"></i></a></li>
                    <li><a href="/Logout"><i class="fas icon-nav fa-power-off"></i></a></li>
                </ul>
            </div>
        </div>
        <!--header menu end-->
        <!--sidebar start-->
        <div class="sidebar">
            <div class="sidebar-menu">
                <center class="profile">
                    <img src="{{ url('/image/profile/profileDefault.png') }}" alt="">
                    <p>ADMIN</p>
                </center>
                <li class="item">
                    <a href="{{ URL::to('/index-admin') }}" class="menu-btn">
                        <i class="fas fa-desktop"></i><span>Trang chủ</span>
                    </a>
                </li>
                <li class="item" id="profile">
                    <a href="#profile" class="menu-btn">
                        <i class="fas fa-user-circle"></i><span>Tài khoản<i class="fas fa-chevron-down drop-down"></i></span>
                    </a>
                    <div class="sub-menu">
                        <a href="{{ URL::to('/view-customer') }}"><i class="fas fa-image"></i><span>Danh sách tài
                                khoản</span></a>
                    </div>
                </li>
                <li class="item" id="messages">
                    <a href="#messages" class="menu-btn">
                        <i class="fas fa-envelope"></i><span>Sản phẩm <i class="fas fa-chevron-down drop-down"></i></span>
                    </a>
                    <div class="sub-menu">
                        <a href="{{ URL::to('/view-product') }}"><i class="fas fa-envelope"></i><span>Xem sản
                                phẩm</span></a>
                        <a href="{{ URL::to('/top-product') }}"><i class="fas fa-envelope-square"></i><span>10 sản phẩm
                                bán chạy</span></a>
                    </div>
                </li>
                <li class="item" id="settings">
                    <a href="#settings" class="menu-btn">
                        <i class="fas fa-cog"></i><span>Đơn hàng<i class="fas fa-chevron-down drop-down"></i></span>
                    </a>
                    <div class="sub-menu">
                        <a href="{{ URL::to('/view-purchase') }}"><i class="fas fa-lock"></i><span>Xem các đơn
                                hàng</span></a>
                    </div>
                </li>
                <li class="item" id="statistic">
                    <a href="#statistic" class="menu-btn">
                        <i class="fas fa-info-circle"></i><span>Thống kê<i class="fas fa-chevron-down drop-down"></i></span>
                    </a>
                    <div class="sub-menu">
                        <a href="{{ URL::to('/revenue-statistic') }}"><i class="fas fa-lock"></i><span>Doanh
                                thu</span></a>

                    </div>
                </li>
            </div>
        </div>

        {{--
        <!--main container start--> --}}
        <section class="main-container">
            @yield('admin-content')
        </section>

        {{--
        <!--main container end--> --}}
    </div>
    <!--wrapper end-->

    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $(".sidebar-btn").click(function() {
                $(".wrapper").toggleClass("collapse");
            });
        });

    </script> --}}

</body>
<footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous">
    </script>
</footer>

</html>