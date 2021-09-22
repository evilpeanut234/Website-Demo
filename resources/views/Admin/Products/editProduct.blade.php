@extends('Admin.AdminPage')
@section('title', 'Chỉnh sửa sản phẩm')
@section('sidebar')
    @parent

@endsection
<style type="text/css">
    .my-image {
        height: 100px;
        width: 100px;
        ;
    }

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
                        <div class="text-header">CHỈNH SỬA SẢN PHẨM</div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="my-form">
            <section class="panel panel-default">
                <div class="panel-body">
                    @if ($msg != '')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{ $msg }}
                        </div>
                    @endif
                    @if ($errors->any())
                        {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                    @endif
                    {{-- <form
                        action="{{ route('editProductDB', ['id' => $product->id_product]) }}" class="form-horizontal"
                        enctype="multipart/form-data" method="post" role="form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="cats" class="col-sm-3 control-label">Loại sản phẩm</label>
                            <div class="col-sm-9">
                                <select name="cats" id="cats">
                                    @foreach ($categoryList as $itemCat)
                                        <option {{ $product->id_Cat == $itemCat->id_Cat ? 'selected' : '' }}
                                            value="{{ $itemCat->id_Cat }}">{{ $itemCat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> <!-- form-group // -->

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Tên sản phẩm</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control my-background" name="name"
                                    value="{{ $product->name }}" id="name" placeholder="Nhập tên sản phẩm">
                            </div>
                        </div> <!-- form-group // -->

                        <div class="form-row">
                            <div class="form-group">
                                <label for="about" class="col-sm-3 control-label">Chi tiết sản phẩm</label>
                                <div class="col-sm-9">
                                    <textarea name="about"
                                        class="form-control my-background">{{ $product->description }}</textarea>
                                </div>
                            </div> <!-- form-group // -->

                            <div class="form-group">
                                <label for="image" class="col-sm-3 control-label">Hình ảnh</label>
                                <div class="col-sm-offset-3 row">
                                    @foreach ($listImage as $item)
                                        <label class="col-sm-2 d-flex flex-column" style="align-items: center;">
                                            <img src="{{ $item->image }}">
                                            <input class="text-center mt-2" type="radio" name="image"
                                                value="{{ $item->image }}"
                                                {{ $product->avatar == $item->image ? 'checked' : '' }}>
                                        </label>
                                    @endforeach
                                </div>
                            </div> <!-- form-group // -->
                            <hr>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-9">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                            </div> <!-- form-group // -->
                    </form> --}}

                    <form action="{{ route('editProductDB', ['id' => $product->id_product]) }}"
                        enctype="multipart/form-data" method="post" role="form">
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="cats">Loại sản phẩm</label>
                                <select name="cats" id="cats" class="form-control my-background">
                                    @foreach ($categoryList as $itemCat)
                                        <option {{ $product->id_Cat == $itemCat->id_Cat ? 'selected' : '' }}
                                            value="{{ $itemCat->id_Cat }}">{{ $itemCat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-9">
                                <label for="name">Tên sản phẩm</label>
                                <input type="text" class="form-control my-background " name="name"
                                    value="{{ $product->name }}" id="name" placeholder="Nhập tên sản phẩm">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="price">Giá tiền</label>
                                <input type="number" class="form-control my-background" name="price" id="price"
                                    value="{{ $product->price }}" placeholder="Giá tiền">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="qty">Số lượng</label>
                                <input type="number" class="form-control my-background" name="qty"
                                    value="{{ $product->quantity }}" id="qty" placeholder="Số lượng"></input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="about">Chi tiết sản phẩm</label>
                            <textarea name="about" class="form-control my-background">{{ $product->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Hình ảnh đại diện</label>
                            <div class="form-row">
                                @foreach ($listImage as $item)
                                    <label class="col-sm-2">
                                        <img class="img-thumbnail my-image" src="{{ $item->image }}">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="image" id="image"
                                                value="{{ $item->image }}"
                                                {{ $product->avatar == $item->image ? 'checked' : '' }}>

                                        </div>
                                        {{-- <input class="form-check-input" type="radio"
                                            name="image" value="{{ $item->image }}"
                                            {{ $product->avatar == $item->image ? 'checked' : '' }}>
                                        --}}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-secondary">Cập nhật</button>
                    </form>
                </div><!-- panel-body // -->
            </section><!-- panel// -->
        </div>


    </div> <!-- container// -->
@endsection
