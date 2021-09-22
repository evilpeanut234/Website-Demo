@extends('Admin.AdminPage')
@section ('title','Sản phẩm')
@section ('sidebar')
@parent

@endsection
@section('admin-content')

    <style>
        .container {
            padding: 2rem 0rem;
        }

        h4 {
            margin: 2rem 0rem 1rem;
        }

        .img-thumbnail {
            height: 70px !important;
        }

        .table-image td,
        .table-image th {
            vertical-align: middle;
        }

        .pagination>li>a:focus,
        .pagination>li>a:hover,
        .pagination>li>span:focus,
        .pagination>li>span:hover {
            z-index: 3;
            color: #fff !important;
            background-color: #2F323A !important;
            border-color: #fff !important;
        }

        .page-item.active .page-link {
            z-index: 3;
            color: #fff !important;
            background-color: #4CCEE8 !important;
            border-color: #949494 !important;
        }

        .page-link {
            color: #fff !important;
            background-color: #212529 !important;
            border-color: #6d6d6d !important;
        }

        .page-link:focus {
            box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25) !important;
        }

        .manipulation {
            z-index: 100 !important;
            font-size: 15px !important;
        }

        .view {
            color: #4CCEE8 !important;
        }

        .delete {
            color: crimson !important;
        }

        .edit {
            color: goldenrod !important;
        }

    </style>
<body <?php if(isset($msg)) echo "onload=".'"show_msg()"';?>>
    <div class="user-control">
        <nav class="nav-admin">
            <div class="admin-nav">
                <div class="admin-nav--item grid-item--left">
                    <div class="content-item-left">
                        <i class="far fa-list-alt "></i>
                        <div class="text-header"> DANH SÁCH CÁC LOẠI SẢN PHẨM</div>
                    </div>
                </div>
    
                <div class="admin-nav--item grid-item--right">
                    <a href="{{ URL::to('/addProductAdmin') }}" class="content-item-right" title="Thêm sản phẩm mới" data-toggle="tooltip">
                        <i class="fas fa-plus-square"></i>
                    </a>
                </div>
            </div>
        </nav>

        {{--@if (isset($msg))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ $msg }}
            </div>
        @endif--}}
        
        <div class="my-table">
            <table class="table table-image table-dark table-hover " id="data">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col head-img" style="text-align: center">Hình ảnh</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Tồn kho</th>
                        <th scope="col">Đơn giá</th>
                        <th scope="col">Lượt thích</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listProducts as $item)
                        <tr>
                            <th scope="row">{{ $item->id_product }}</th>
                            <td class="w-25">
                                <img src="{{ $item->avatar }}" class="img-fluid img-thumbnail"
                                    alt="Sheep">
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price, 0, '', '.') }} VNĐ</td>
                            <td>{{ $item->liked }}</td>
                            <td>
                                <a class="manipulation view" href="/{{$item->id_Cat}}/{{$item->id_product}}" title="Xem" data-toggle="tooltip"><i
                                        class="fas fa-eye"></i></a>
                                <a class="manipulation delete" href="{{ route('removeProduct', ['id' => $item->id_product]) }}" title="Xóa" data-toggle="tooltip"><i
                                        class="fas fa-minus-circle "></i></a>
                                <a class="manipulation edit" href="{{ URL::to('/product/edit/'.$item->id_product.'') }}" title="Sửa" data-toggle="tooltip"><i
                                        class="fas fa-pen-square"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

    <script type="text/javascript">
$(document).ready(function() {
        //phân trang
        $('#data').after(
            '<div class="row mt-2"><nav id="pageginNum" aria-label="Page navigation example pagination-secondary" style="margin: 0 auto"><ul id="nav" class="pagination"></ul></div>'
            );
        var rowsShown = 5;
        var rowsTotal = $('#data tbody tr').length;
        var numPages = rowsTotal / rowsShown;
        if(numPages > 1)
        {

            for (i = 0; i < numPages; i++) {
                var pageNum = i + 1;
                $('#nav').append(
                    '<li class="page-item"><a class="page-link" rel="' +
                    i + '">' + pageNum + '</a></li> ');
            }
            $('#data tbody tr').hide();
            $('#data tbody tr').slice(0, rowsShown).show();
            $('#nav a:first').addClass('active');
            $('#nav a').bind('click', function() {
                $('#nav a').removeClass('active');
                $(this).addClass('active');
                var currPage = $(this).attr('rel');
                var startItem = currPage * rowsShown;
                var endItem = startItem + rowsShown;
                $('#data tbody tr').css('opacity', '0.0').hide().slice(
                    startItem, endItem).
                css('display', 'table-row').animate({
                    opacity: 1
                }, 300);
            });
        }
        //phân trang

});

function show_msg()
{
    alert("xóa thành công");
}
</script>

@endsection
