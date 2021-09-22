@extends('layouts.default')
@section('title','Tìm kiếm')
@section ('sidebar')
@parent
@endsection
@section('content')
<div class="all-product section">
    @if(isset($listProduct))
    @if(count($listProduct) == 0)
    không tìm thấy sản phẩm
    @else
    <div class="row justify-content-md-center"  id="search">
        @foreach($listProduct as $product)
        <div class="col-md-4" id="img-search">
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
    @endif
    @endif
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('.btn-price').on('click', function() {
                var id = $(this).data('key');
                var quantity = 0;
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
        $('#search').after(
            '<div class="row mt-2"><nav id="pageginNum" aria-label="Page navigation example pagination-secondary" style="margin: 0 auto"><ul id="nav" class="pagination"></ul></div>'
            );
        var rowsShown = 6;
        var rowsTotal = $('#search #img-search').length;
        var numPages = rowsTotal / rowsShown;
        if(numPages > 1)
        {

            for (i = 0; i < numPages; i++) {
                var pageNum = i + 1;
                $('#nav').append(
                    '<li class="page-item"><a class="page-link" rel="' +
                    i + '">' + pageNum + '</a></li> ');
            }
            $('#search #img-search').hide();
            $('#search #img-search').slice(0, rowsShown).show();
            $('#nav a:first').addClass('active');
            $('#nav a').bind('click', function() {
                $('#nav a').removeClass('active');
                $(this).addClass('active');
                var currPage = $(this).attr('rel');
                var startItem = currPage * rowsShown;
                var endItem = startItem + rowsShown;
                $('#search #img-search').css('opacity', '0.0').hide().slice(
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
