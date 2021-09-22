@extends('layouts.default')
@section('title','Trang chủ')
@section ('sidebar')
@parent
@endsection
@section('content')
@if (session('status'))
<div class="container">
    <div class="alert alert-success" style="margin-top:15%" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('status') }}
    </div>
</div>
@endif
@endsection
