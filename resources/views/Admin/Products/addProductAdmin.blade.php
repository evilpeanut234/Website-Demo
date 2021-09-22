@extends('Admin.AdminPage')
@section('title', 'Thêm sản phẩm')
@section('sidebar')
    @parent

@endsection
<style type="text/css">
    .alert-dismissible .btn-close{
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
                        <div class="text-header">THÊM SẢN PHẨM MỚI</div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="my-form">

            <section class="panel panel-default">
                <div class="panel-body">
                    @if ($msg != '')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">×</button>
                            {{ $msg }}
                        </div>
                    @endif
                    @if ($errors->any())

                        {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                    @endif
                    <form action="addProductAdmin" class="form-horizontal" enctype="multipart/form-data" method="post"
                        role="form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="cats" class="col-sm-3 control-label">Loại sản phẩm</label>
                            <div class="col-sm-9">
                                <select name="cats" id="cats" class="form-control my-background">
                                    @foreach ($categoryList as $itemCat)
                                        <option value="{{ $itemCat->id_Cat }}">{{ $itemCat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> <!-- form-group // -->

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Tên sản phẩm</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control my-background" name="name" id="name"
                                    placeholder="Nhập tên sản phẩm">
                            </div>
                        </div> <!-- form-group // -->
                        <div class="form-group">
                            <label for="price" class="col-sm-3 control-label">Giá tiền</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control my-background" name="price" id="price"
                                    placeholder="Giá tiền">
                            </div>
                        </div> <!-- form-group // -->
                        <div class="form-group">
                            <label for="about" class="col-sm-3 control-label">Chi tiết sản phẩm</label>
                            <div class="col-sm-9">
                                <textarea name="about" class="form-control my-background"></textarea>
                            </div>
                        </div> <!-- form-group // -->
                        <div class="form-group">
                            <label for="qty" class="col-sm-3 control-label my-background">Số lượng</label>
                            <div class="col-sm-3">
                                <input type="number" min="0" class="form-control my-background" name="qty" id="qty"
                                    placeholder="Số lượng">
                            </div>
                        </div> <!-- form-group // -->
                        <div class="form-group">
                            <label for="image" class="col-sm-3 control-label my-background">Hình ảnh</label>
                            <div class="col-sm-9">
                                <input type="file" accept="image/gif, image/jpeg" class="form-control" name="images[]"
                                    id="images" multiple>
                            </div>
                        </div> <!-- form-group // -->
                        <hr>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-secondary admin-button">Thêm</button>
                            </div>
                        </div> <!-- form-group // -->
                    </form>
                </div><!-- panel-body // -->
            </section><!-- panel// -->

        </div>

    </div>


@endsection
