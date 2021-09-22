@extends('layouts.default')
@section('title', $product->name)
@section('sidebar')
@parent
@endsection
@section('content')

<div class="container">
    <div class="card">
        <div class="container-fluid">
            <div class="wrapper row">
                <div class="preview col-md-6">
                    <div class="preview-pic tab-content">
                        <div class="tab-pane active" id="pic-1"><img
                                src="{{ $product->avatar }}" /></div>
                        @php($counter = 2)
                        @foreach ($imageDetail as $image)
                        <div class="tab-pane" id="pic-{{ $counter }}"><img
                                src="{{ $image->image }}" /></div>
                        @php($counter = $counter + 1)

                        @endforeach
                    </div>
                    <ul class="preview-thumbnail nav nav-tabs">
                        @php($counter = 2)
                        @foreach ($imageDetail as $image)

                        <li><a data-target="#pic-{{ $counter }}" data-toggle="tab"><img
                                    src="{{ $image->image }}" /></a>
                        </li>
                        @php($counter = $counter + 1)

                        @endforeach
                    </ul>

                </div>
                <div class="col-md-6">
                    <div class="details">
                        <h3 class="product-title" style="font-size: 24;"> {{ $product->name }}</h3>
                        <div class="button-edit-admin">
                            <button class="like btn btn-default d-inline" type="button" id="{{ $product->id_product }}"
                                style="transform: translate(-20%, 0%);
                                                font-size: 20;">
                                @if ($liked)
                                <a class="fa fa-heart" style="color: red;" id="heart"></a>
                                @else
                                <a class="fa fa-heart" id="heart"></a>
                                @endif
                            </button>
                            @if ($checkAdmin)
                            <a href="{{ route('editProduct', ['id' => $product->id_product]) }}"><i
                                    class="far fa-edit"></i></a>
                            <a href="{{ route('removeProduct', ['id' => $product->id_product]) }}"><i
                                    class="far fa-trash-alt"></i></a>
                            @endif
                        </div>
                        <p class="product-description">{{ $product->description }}</p>
                        <h4 class="price">Giá: <span><?php echo number_format($product->price, 0); ?> VNĐ</span></h4>
                        <p>Số lượt thích <strong id="likes">{{ $product->liked }}</strong></p>
                        <p>Sản phẩm trong kho <strong>{{ $product->quantity }}</strong></p>
                        <div class="action">
                            <div class="row mt-4 no-gutters mx-auto">

                                <form method="get" action="/product/addToCart/{{ $product->id_product }}">
                                    <div class="mr-2">
                                        {{ csrf_field() }}
                                        <p>Số lượng</p>
                                        <input type="number" step="1" min="1" max="{{ $product->quantity }}"
                                            name="quantity" class="form-control" />
                                    </div>
                                    <div>
                                        <p style="margin-top:20px " data-key="{{$product->id_product}}"
                                            class="btn btn-outline-dark text-primary font-weight-bold add-item-btn">
                                            Thêm vào giỏ hàng</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container mb-5 mt-5 comment">
        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    @if (session()->has('user'))
                    <div class="well">
                        <h3 class="text-center mb-5 title-cmt">Viết bình luận</h3>
                        <form action="/product/comment/{{ $product->id_product }}" method="post">
                            @csrf

                            @method('POST')
                            <div class="form mb-2">
                                <textarea class="form-control" rows="2" name="textComment"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-cmt">Gửi bình luận</button>
                        </form>
                    </div>
                    @endif
                </div>
                <div class="col-md-12">
                    <h3 class="text-center mb-5"> Nhận xét sản phẩm </h3>
                    <div class="row" id="data">
                        @foreach ($listComments as $cmt)
                        <div class="col-md-12">
                            <div class="media">
                                <div class="media-body">
                                    <div class="row">
                                        <div class="col-8 d-flex">
                                            <h5>{{ $cmt->username }}</h5> <span> -
                                                {{ date('d-m-Y', strtotime($cmt->time)) }}</span>
                                        </div>
                                    </div> {{ $cmt->content }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        let like = {
            value: {{$product->liked}}
        };
        $('.like').click(function() {
            if ({{session()->has('user')}}) {
                checkHeart(like);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('ajax.likeProduct') }}",
                    data: {
                        id: {{$product->id_product}}
                    }
                })
            }
        })

        PhanTrang();
        //thêm sản Phẩm
        $('.add-item-btn').on('click', function() {
            var id = $(this).data('key');
            var quantity = $("input[name=quantity]").val();
            if (quantity === "") {
                quantity = 0;
            } else {
                quantity = parseInt(quantity);
            }
            console.log(id, quantity);
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
                    alert(response.msg);
                    $("input[name=quantity]").val() = "";
                }
            })

        });
    });

    function checkHeart(like) {
        var heart = document.getElementById("heart");
        if (heart.style.color == "red") {
            heart.style.color = "black";
            $('#likes').text(--like.value);
        } else {
            heart.style.color = "red";
            $('#likes').text(++like.value);
        }
    }

    function PhanTrang()
    {
        //phân trang
        $('#data').after(
            '<div class="row mt-2"><nav id="pageginNum" aria-label="Page navigation example pagination-secondary" style="margin: 0 auto"><ul id="nav" class="pagination"></ul></div>'
        );
        var rowsShown = 5;
        var rowsTotal = $('#data .media-body').length;
        var numPages = rowsTotal / rowsShown;
        if (numPages > 1) {

            for (i = 0; i < numPages; i++) {
                var pageNum = i + 1;
                $('#nav').append(
                    '<li class="page-item"><a class="page-link" rel="' +
                    i + '">' + pageNum + '</a></li> ');
            }
            $('#data .media-body').hide();
            $('#data .media-body').slice(0, rowsShown).show();
            $('#nav a:first').addClass('active');
            $('#nav a').bind('click', function() {
                $('#nav a').removeClass('active');
                $(this).addClass('active');
                var currPage = $(this).attr('rel');
                var startItem = currPage * rowsShown;
                var endItem = startItem + rowsShown;
                $('#data .media-body').css('opacity', '0.0').hide().slice(
                    startItem, endItem).
                css('display', 'table-row').animate({
                    opacity: 1
                }, 300);
            });
        }
    }
    </script>
    @endsection