@extends('layouts.default')
@section('title', 'Trang cá nhân')
@section('sidebar')
    @parent
@endsection
@section('content')
    <style type="text/css">
        .profile-box_1620 {
            border-radius: 12px;
            position: relative;
            background: #fff;
            padding: 30px;
            box-shadow: 0px 20px 80px 0px rgba(153, 153, 153, 0.3);
            margin: 50px 165px; 

        }

        .profile-banner_inner {
            position: relative;
            width: 100%;
            display: flex;
        }

        .profile-d-flex {
            display: -ms-flexbox !important;
            display: flex !important;
        }
        .profile-media .profile-d-flex{
            height: 200px;
            width: 200px;
            margin-right: 50px;
        }

        .profile-banner_inner .profile-banner_content .profile-media .profile-d-flex {
            padding-right: 125px;
        }

        .align-items-center {
            -ms-flex-align: center !important;
            align-items: center !important;
        }

        .profile-banner_content {
            color: #222222;
            vertical-align: middle;
            align-self: center;
            text-align: left;
        }

        .profile-media {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: start;
            align-items: flex-start;
        }

        .profile-media-body {
            vertical-align: middle;
            align-self: center;
            -ms-flex: 1;
            flex: 1;
        }


    </style>
    {{-- <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Tên người nhận</th>
                    <th>Tổng đơn hàng</th>
                    <th>Ngày mua</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listPurchases as $item)
                    <tr>
                        <td>{{ $item->id_purchase }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ number_format($item->total, 0, '', '.') }} VNĐ</td>
                        <td> {{ $item->created_at }}</td>
                        <td><label
                                class="badge {{ $item->status == '1' ? 'badge-secondary' : ($item->status == '2' ? 'badge-danger' : ($item->status == '3' ? 'badge-light' : ($item->status == '4' ? 'badge-warning' : 'badge-success'))) }}">{{ $item->description }}</label>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}

    <div class="profile-box_1620">
        <div class="profile-banner_inner profile-d-flex align-items-center">
            <div class="banner_content">
                <div class="profile-media">
                    <div class="profile-media-body">
                        <div class="personal_text">
                            <h6>Hello!</h6>
                            <h3>{{$currentUser->username}}</h3>
                            <p><strong>Chăm ngôn sống:</strong> Cuộc sống có lắm điều ngang trái!</p>
                            <ul class="list basic_info">
                                <li><a href="#"><i class="lnr lnr-phone-handset"></i></a></li>
                                <li><a href="#"><i class="lnr lnr-envelope"></i>{{$currentUser->email}}</a></li>
                                <li><a href="#"><i class="lnr lnr-home"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="profile-box_1620">
        <div class="section-title">
            <h2 class="title-product-like" style="color: black;">Các sản phẩm đã thích</h2>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col head-img" style="text-align: center">Hình ảnh</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col" style="color:red;"><i class="fas fa-heart"></i></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($likedProducts as $item)
                    <tr>
                        <th scope="row">{{ $item->id_product }}</th>
                        <td class="w-25">
                            <img src="{{ $item->avatar }}" class="img-fluid img-thumbnail"
                                alt="Sheep">
                        </td>
                        <td><a href="{{ URL::to('/'.$item->id_Cat.'/'.$item->id_product)}}">{{ $item->name }} </a></td>
                    <td><div class="rating text-right" style="color:red;"> <i class="fas fa-heart"></i>
                        {{ $item->liked }}
                    </div></td>
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>

    {{-- <div class="row">
        <div class="col-9">
            <div class="section-main-3">
                <div class="all-product section-3">
                    <div class="section-title">
                        <h2 class="title-product-like">Các sản phẩm đã thích</h2>
                    </div>
                    <div class="row justify-content-md-center" id="like-product">
                        @foreach ($likedProducts as $product)
                            <div class="col-md-4" id="list-product">
                                <figure class="card card-product-grid card-lg"> <a
                                        href="/{{ $product->id_Cat }}/{{ $product->id_product }}" class="img-wrap"
                                        data-abc="true">
                                        <img src="{{ $product->avatar }}"></a>
                                    <figcaption class="info-wrap">
                                        <div class="row">
                                            <div class="col-md-9"> <a
                                                    href="/{{ $product->id_Cat }}/{{ $product->id_product }}" class="title"
                                                    data-toggle="tooltip" data-placement="bottom"
                                                    title="{{ $product->name }}" data-abc="true">{{ $product->name }}</a>
                                            </div>
                                            <div class="col-md-3 rating-edit">
                                                <div class="rating text-right"> <i class="fas fa-heart"></i>
                                                    {{ $product->liked }}
                                                </div>
                                            </div>
                                        </div>
                                    </figcaption>
                                    <div class="bottom-wrap">
                                        <div class="price-wrap"> <span
                                                class="price h5">{{ number_format($product->price, 0, '', ',') }}
                                                VNĐ</span> <br> <small class="text-success">Free shipping</small>
                                        </div>
                                    </div>
                                    <p class="btn btn-primary float-right btn-price" data-key="{{ $product->id_product }}"
                                        data-abc="true"> Mua ngay </p>
                                </figure>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-lg-8 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Danh sách các món hàng đã mua</h4>
                            <p class="card-description"> Khách hàng: </p>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Mã đơn hàng</th>
                                            <th>Tên người nhận</th>
                                            <th>Tổng đơn hàng</th>
                                            <th>Ngày mua</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listPurchases as $item)
                                            <tr>
                                                <td>{{ $item->id_purchase }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ number_format($item->total, 0, '', '.') }} VNĐ</td>
                                                <td> {{ $item->created_at }}</td>
                                                <td><label
                                                        class="badge {{ $item->status == '1' ? 'badge-secondary' : ($item->status == '2' ? 'badge-danger' : ($item->status == '3' ? 'badge-light' : ($item->status == '4' ? 'badge-warning' : 'badge-success'))) }}">{{ $item->description }}</label>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <script type="text/javascript">
        $(document).ready(function() {
            //phân trang
            $('#like-product').after(
                '<div class="row mt-2"><nav id="pageginNum" aria-label="Page navigation example pagination-secondary" style="margin: 0 auto"><ul id="nav" class="pagination"></ul></div>'
            );
            var rowsShown = 9;
            var rowsTotal = $('#like-product #list-product').length;
            var numPages = rowsTotal / rowsShown;
            if (numPages > 1) {
                for (i = 0; i < numPages; i++) {
                    var pageNum = i + 1;
                    $('#nav').append(
                        '<li class="page-item"><a class="page-link" rel="' +
                        i + '">' + pageNum + '</a></li> ');
                }
                $('#like-product #list-product').hide();
                $('#like-product #list-product').slice(0, rowsShown).show();
                $('#nav a:first').addClass('active');
                $('#nav a').bind('click', function() {
                    $('#nav a').removeClass('active');
                    $(this).addClass('active');
                    var currPage = $(this).attr('rel');
                    var startItem = currPage * rowsShown;
                    var endItem = startItem + rowsShown;
                    $('#like-product #list-product').css('opacity', '0.0').hide().slice(
                        startItem, endItem).
                    css('display', 'table-row').animate({
                        opacity: 1
                    }, 300);
                });
            }
            //phân trang

        });

    </script>
@endsection
