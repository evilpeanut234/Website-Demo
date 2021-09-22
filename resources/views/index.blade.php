@extends('layouts.default')
@section('title','Trang chủ')
@section ('sidebar')
@parent
@endsection
@section('content')
<div class="menu-main">
        <nav class="nav">
            <ul class="menu">
                <li class="menu-item">
                    <img src="{{url('/image/icon/mobile-phone.svg')}}" class="menu-link-icon" width="20px" height="auto" alt="phone">
                    <a href="http://127.0.0.1:8000/search?_token=C0oBTkEkuNs5CvZzjmdd6YIAZE6z1gvIpNkCIaqE&keyword=%C4%91i%E1%BB%87n+tho%E1%BA%A1i" class="menu-link">Điện thoại</i> </a>
                </li>
                <li class="menu-item">
                    <img src="{{url('/image/icon/laptop.svg')}}" class="menu-link-icon" width="20px" height="auto" alt="laptop">
                    <a href="http://127.0.0.1:8000/search?_token=C0oBTkEkuNs5CvZzjmdd6YIAZE6z1gvIpNkCIaqE&keyword=lap" class="menu-link">Laptop</i> </a>
                </li>
                <li class="menu-item">
                    <img src="{{url('/image/icon/tablet.svg')}}" class="menu-link-icon" width="20px" height="auto" alt="tablet">
                    <a href="http://127.0.0.1:8000/search?_token=C0oBTkEkuNs5CvZzjmdd6YIAZE6z1gvIpNkCIaqE&keyword=may+tinh+bang" class="menu-link">Máy tính bảng</i> </a>
                </li>
                <li class="menu-item">
                    <img src="{{url('/image/icon/information.svg')}}" class="menu-link-icon" width="20px" height="auto" alt="loa">
                    <a href="https://www.techz.vn/C/smart-phone-dien-thoai-138" class="menu-link">Tin công nghệ</i> </a>
                </li>
                <li class="menu-item">
                    <img src="{{url('/image/icon/information.svg')}}" class="menu-link-icon" width="20px" height="auto" alt="loa">
                    <a href="https://www.techz.vn/C/smart-phone-dien-thoai-138" class="menu-link">Bảng tin</i> </a>
                </li>
            </ul>
        </nav>
</div>
@if(isset($categoryList))
<div class="row">
    <div class="col-9">
        <div id="carouselExampleIndicators" class="carousel slide carousel" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
            </ol>
            <div class="carousel-inner">
                     <div class="carousel-item active">
                    <img src="{{url('/image/background/thang-samsung-giam-gia-khung-didongviet-.jpg')}}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{url('/image/background/photo-1-1618904141770885585268.jpg')}}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{url('/image/background/xa-kho-laptop-800-300-800x300-1.png')}}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{url('/image/background/800-300-800x300-13.png')}}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{url('/image/background/baiviet-iphonegiamgiasoc-01.png')}}" class="d-block w-100" alt="...">
                </div>

            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
@endif

@if(isset($topSaleProduct))
<div class="row">
    <div class="col-9">
    <div class="section-main">
<div class="popular-product section-1">
    <div class="section-title">
        <h2 class="title-best-product">Sản phẩm bán chạy nhất</h2>
    </div>
    <div class="row container-fluid">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="owl-carousel">
                @foreach($topSaleProduct as $product)
                <div>
                    <figure class="card card-product-grid card-lg">
                         <a href="/{{$product->id_Cat}}/{{$product->id_product}}"
                         class="img-wrap" data-abc="true">
                            <img src="{{$product->avatar}}"></a>
                        <figcaption class="info-wrap">
                            <div class="row ">
                                <div class="col-md-9"> <a href="/{{$product->id_Cat}}/{{$product->id_product}}" class="title" data-toggle="tooltip" data-placement="bottom" title="{{$product->name}}" data-abc="true">{{$product->name}}</a> </div>
                                <div class="col-md-3 rating-edit">
                                    <div class="rating text-right"> <i class="fas fa-heart"></i> {{$product->liked}}
                                    </div>
                                </div>
                            </div>
                        </figcaption>
                        <div class="bottom-wrap">
                            <div class="price-wrap"> <span class="price h5">{{number_format($product->price, 0, '', ',')}} VNĐ</span> <br>
                                <small class="text-success">Free shipping</small> </div>
                        </div>
                        <p class="btn btn-primary float-right btn-price" data-key="{{$product->id_product}}" data-abc="true"> Mua ngay </p>
                    </figure>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
</div>
    </div>
</div>

<div class="row">
    <div class="col-9">
        <div class="section-main-2">
<div class="all-product section-2">
    <div class="section-title">
        <h2 class="title-all-product">Tất cả sản phẩm</h2>
    </div>
    <div class="row justify-content-md-center" id="all-product">
        @foreach($productList as $product)
        <div class="col-md-4" id="list-img">
            <figure class="card card-product-grid card-lg"> <a href="/{{$product->id_Cat}}/{{$product->id_product}}" class="img-wrap" data-abc="true">
                    <img src="{{$product->avatar}}"></a>
                <figcaption class="info-wrap">
                    <div class="row">
                        <div class="col-md-9 "> <a href="/{{$product->id_Cat}}/{{$product->id_product}}" class="title" data-toggle="tooltip" data-placement="bottom" title="{{$product->name}}" data-abc="true">{{$product->name}}</a> </div>
                        <div class="col-md-3 rating-edit">
                            <div class="rating text-right"> <i class="fas fa-heart"></i> {{$product->liked}}</div>
                        </div>
                    </div>
                </figcaption>
                <div class="bottom-wrap">
                    <div class="price-wrap"> <span class="price h5">{{number_format($product->price, 0, '', ',')}}
                            VNĐ</span> <br> <small class="text-success">Free shipping</small> </div>
                </div>
                <p class="btn btn-primary float-right btn-price" data-key="{{$product->id_product}}" data-abc="true"> Mua ngay </p>

            </figure>
        </div>
        @endforeach
    </div>
</div>
</div>
    </div>
</div>

</div>
@endif

@if(isset($topLikeProduct))
<div class="row">
    <div class="col-9">
    <div class="section-main-3">
<div class="all-product section-3">
    <div class="section-title">
        <h2 class="title-product-like">Sản Phẩm Được Yêu Thích Nhất</h2>
    </div>
    <div class="row justify-content-md-center">
        @foreach($topLikeProduct as $product)
        <div class="col-md-4">
            <figure class="card card-product-grid card-lg"> <a href="/{{$product->id_Cat}}/{{$product->id_product}}" class="img-wrap" data-abc="true">
                    <img src="{{$product->avatar}}"></a>
                <figcaption class="info-wrap">
                    <div class="row">
                        <div class="col-md-9"> <a href="/{{$product->id_Cat}}/{{$product->id_product}}" class="title" data-toggle="tooltip" data-placement="bottom" title="{{$product->name}}" data-abc="true">{{$product->name}}</a> </div>
                        <div class="col-md-3 rating-edit">
                            <div class="rating text-right"> <i class="fas fa-heart"></i> {{$product->liked}}</div>
                        </div>
                    </div>
                </figcaption>
                <div class="bottom-wrap">
                    <div class="price-wrap"> <span class="price h5">{{number_format($product->price, 0, '', ',')}}
                            VNĐ</span> <br> <small class="text-success">Free shipping</small>
                        </div>
                </div>
                <p class="btn btn-primary float-right btn-price" data-key="{{$product->id_product}}" data-abc="true"> Mua ngay </p>
            </figure>
        </div>
        @endforeach
    </div>
</div></div>
    </div>
</div>
@endif

@if(isset($topNewProduct))
<div class="row">
    <div class="col-9">
    <div class="section-main-4">
<div class="all-product section-4">
    <div class="section-title">
        <h2 class="title-new-product">Sản Phẩm Mới Nhất</h2>
    </div>
    <div class="row justify-content-md-center">
        @foreach($topNewProduct as $product)
        <div class="col-md-4">
            <figure class="card card-product-grid card-lg"> <a href="/{{$product->id_Cat}}/{{$product->id_product}}" class="img-wrap" data-abc="true">
                    <img src="{{$product->avatar}}"></a>
                <figcaption class="info-wrap">
                    <div class="row">
                        <div class="col-md-9"> <a href="/{{$product->id_Cat}}/{{$product->id_product}}" class="title" data-toggle="tooltip" data-placement="bottom" title="{{$product->name}}" data-abc="true">{{$product->name}}</a> </div>
                        <div class="col-md-3 rating-edit">
                            <div class="rating text-right"> <i class="fas fa-heart"></i> {{$product->liked}}</div>
                        </div>
                    </div>
                </figcaption>
                <div class="bottom-wrap">
                    <div class="price-wrap"> <span class="price h5">{{number_format($product->price, 0, '', ',')}}
                            VNĐ</span> <br> <small class="text-success">Free shipping</small>
                        </div>
                    </div>
                      <p class="btn btn-primary float-right btn-price" data-key="{{$product->id_product}}" data-abc="true"> Mua ngay </p>
            </figure>
        </div>
        @endforeach
    </div>
</div>
</div>
</div>
</div>
@endif

<script type="text/javascript">
        $(document).ready(function() {
            $('.btn-price').on('click', function() {
                var id = $(this).data('key');
                var quantity = 0;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('addToCart') }}",
                    data: {
                        id: id,
                        quantity: quantity
                    },
                    success: function(response) {
                        if(response.msg!=undefined){
                            alert(response.msg);
                        }
                        else{
                            alert("Đăng nhập để tiếp tục");
                            
                        }
                    }
                })

            });
         //phân trang
         $('#all-product').after(
            '<div class="row mt-2"><nav id="pageginNum" aria-label="Page navigation example pagination-secondary" style="margin: 0 auto"><ul id="nav" class="pagination"></ul></div>'
            );
        var rowsShown = 9;
        var rowsTotal = $('#all-product #list-img').length;
        var numPages = rowsTotal / rowsShown;
        if(numPages > 1)
        {
            for (i = 0; i < numPages; i++) {
                var pageNum = i + 1;
                $('#nav').append(
                    '<li class="page-item"><a class="page-link" rel="' +
                    i + '">' + pageNum + '</a></li> ');
            }
            $('#all-product #list-img').hide();
            $('#all-product #list-img').slice(0, rowsShown).show();
            $('#nav a:first').addClass('active');
            $('#nav a').bind('click', function() {
                $('#nav a').removeClass('active');
                $(this).addClass('active');
                var currPage = $(this).attr('rel');
                var startItem = currPage * rowsShown;
                var endItem = startItem + rowsShown;
                $('#all-product #list-img').css('opacity', '0.0').hide().slice(
                    startItem, endItem).
                css('display', 'table-row').animate({
                    opacity: 1
                }, 300);
            });
        }
    });
</script>
@endsection
