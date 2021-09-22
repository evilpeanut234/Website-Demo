@extends('layouts.default')
@section('title','Thêm sản phẩm')
@section ('sidebar')
@parent
@endsection
@section('content')

<div class="container">

    <section class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Thêm sản phẩm</h3>
        </div>
        <div class="panel-body">
            @if ($msg != "")
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ $msg }}
            </div>
            @endif
            @if($errors->any())

            {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <form action="/AddProduct" class="form-horizontal" enctype="multipart/form-data" method="post" role="form">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="cats" class="col-sm-3 control-label">Loại sản phẩm</label>
                    <div class="col-sm-9">
                        <select name="cats" id="cats">
                            @foreach($categoryList as $itemCat)
                            <option value="{{$itemCat->id_Cat}}">{{$itemCat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> <!-- form-group // -->

                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Tên sản phẩm</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên sản phẩm">
                    </div>
                </div> <!-- form-group // -->
                <div class="form-group">
                    <label for="price" class="col-sm-3 control-label">Giá tiền</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="price" id="price" placeholder="Giá tiền">
                    </div>
                </div> <!-- form-group // -->
                <div class="form-group">
                    <label for="about" class="col-sm-3 control-label">Chi tiết sản phẩm</label>
                    <div class="col-sm-9">
                        <textarea name="about" class="form-control"></textarea>
                    </div>
                </div> <!-- form-group // -->
                <div class="form-group">
                    <label for="qty" class="col-sm-3 control-label">Số lượng</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="qty" id="qty" placeholder="Số lượng">
                    </div>
                </div> <!-- form-group // -->
                <div class="form-group">
                    <label for="image" class="col-sm-3 control-label">Hình ảnh</label>
                    <div class="col-sm-9">
                        <input type="file" accept="image/gif, image/jpeg" class="form-control" name="images[]" id="images" multiple>
                    </div>
                </div> <!-- form-group // -->
                <hr>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </div> <!-- form-group // -->
            </form>
        </div><!-- panel-body // -->
    </section><!-- panel// -->


</div> <!-- container// -->
@endsection
