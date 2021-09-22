@extends('Admin.AdminPage')
@section('title', 'Người dùng')
@section('sidebar')
    @parent

@endsection
<style>
    .manipulation {
        z-index: 100 !important;
    }

    .icon-delete {
        text-align: center;
    }

    .alert-dismissible .btn-close {
        padding: 1rem !important;
    }

</style>
@section('admin-content')

    <div class="user-control">
        <nav class="nav-admin">
            <div class="admin-nav">
                <div class="admin-nav--item grid-item--left">
                    <div class="content-item-left">
                        <i class="far fa-list-alt "></i>
                        <div class="text-header"> DANH SÁCH CÁC TÀI KHOẢN</div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="my-table">
            @if ($msg != '')
                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    {{ $msg }}
                </div>
            @endif
            <table class="table table-image table-dark table-hover" id="data">
                <thead>
                    <tr>
                        <th scope="col" class="font-weight-bold">Id</th>
                        <th scope="col" class="font-weight-bold">Username</th>
                        <th scope="col" class="font-weight-bold">Email</th>
                        <th scope="col" class="font-weight-bold">Ngày tạo</th>
                        <th scope="col" class="font-weight-bold">Quyền truy cập</th>
                        <th scope="col" class="font-weight-bold">Xóa người dùng</th>
                    </tr>
                <tbody>
                    @foreach ($listCustomer as $item)
                        <tr id="{{ $item->id }}">

                            <td>{{ $item->id }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <select name="status" class="form-control my-background changeRole">
                                    @if ($item->role == 1)
                                        <option selected="selected" value="1">Quản trị viên</option>
                                        <option value="-1">Người dùng</option>
                                    @else
                                        <option value="1">Quản trị viên</option>
                                        <option selected="selected" value="-1">Người dùng</option>
                                    @endif
                                </select>
                            </td>
                            <td class="icon-delete">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $item->id }}">
                                    <i class="far fa-trash-alt"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel" style="color:black;">Thông
                                                    báo</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close<"></button>
                                            </div>
                                            <div class="modal-body" style="color:black;">Bạn có thật sự muốn xóa người dùng
                                                "{{ $item->username }}"!</div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Không</button>
                                                <a href="{{ route('removeUser', ['id' => $item->id]) }}"
                                                    style="background-color:#dc3545 !important; border-color: #dc3545 !important"
                                                    class="btn btn-danger">Có</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <a class="manipulation delete"
                                    href="{{ route('removeUser', ['id' => $item->id]) }}" title="Xóa"
                                    data-toggle="tooltip"><i class="far fa-trash-alt"></i></a>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.changeRole').on('change', function() {
                var id = $(this).closest('tr').attr('id');
                var value = $(this).val();
                console.log(id, value);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('changeRole') }}",
                    data: {
                        id: id,
                        value: value
                    }
                })
            })
            //phân trang
            $('#data').after(
                '<div class="row mt-2"><nav id="pageginNum" aria-label="Page navigation example pagination-secondary" style="margin: 0 auto"><ul id="nav" class="pagination"></ul></div>'
            );
            var rowsShown = 8;
            var rowsTotal = $('#data tbody tr').length;
            var numPages = rowsTotal / rowsShown;
            if (numPages > 1) {

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

    </script>

@endsection
