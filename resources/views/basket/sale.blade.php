@extends('layouts.app')
@section('title',"Maxsulotni sotish")
@section('content__title')
    Maxsulotni yakka xolatda sotish
@endsection
@section('content')
@if ($errors->any())
<div class="alert alert-danger pt-4 mt-3">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if (session('success'))
<div class="alert alert-success pt-4 mt-3">
    <ul>
        <li>{{ session('success') }}</li>
    </ul>
</div>
@endif
<form action="{{ route('basket.saleOne',$product->id) }}" method="post">
    @csrf
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12 my-3">
            <i>Nomi</i>
            <h4>{{ $product->name }}</h4>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 my-3">
            <i>Qolgan soni</i>
            <h4>{{ $product->amount }}</h4>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 my-3">
            <i>Sotiladigan narxi</i>
            <input type="number" class="form-control" name="sale_price" value="{{ $product->sale_price }}">
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 my-3">
            <i>Soni</i>
            <input type="number" class="form-control" name="product_count" placeholder="Maxsulot sonini kiriting..." value="1">
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 my-3">
            <div class="d-flex justify-content-end">
                <a href="{{ route('basket.index') }}" class="btn btn-danger mr-1">Orqaga</a>
                <button type="submit" class="btn btn-primary">Sotish</button>
            </div>
        </div>
    </div>
</form>
@endsection