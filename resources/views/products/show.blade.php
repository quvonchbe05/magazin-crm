@extends('layouts.app')
@section('title',"Maxsulotni taxrirlash")
@section('content__title')
Maxsulot xaqida to'liq ma'lumot
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
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12 my-4">
        <i>Nomi:</i>
        <h4>{{ $product->name }}</h4>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 my-4">
        <i>Kategoriya:</i>
        <h4>@if (isset($product->category->cat_name))        
            {{ $product->category->cat_name}}
            @else
            <span class="text-danger">O'chirib yuborilgan</span>
            @endif</h4>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 my-4">
        <i>Soni/Kg:</i>
        <h4>{{ $product->amount }}</h4>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 my-4">
        <i>Asl narxi:</i>
        <h4>{{ $product->original_price }}</h4>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 my-4">
        <i>Sotiladigan narxi:</i>
        <h4>{{ $product->sale_price }}</h4>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 my-4">
        <i>Saqlash muddati:</i>
        <h4>
            @if ($product->deadLine)
            {{ $product->deadLine }}
            @else
            Mavjud emas
            @endif
        </h4>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 my-4">
        <i>Maxsulotni qabul qilgan xodim:</i>
        <h4>
            @if (isset($product->worker->fish))        
            {{ $product->worker->fish }}
            @else
            <span class="text-danger">O'chirib yuborilgan</span>
            @endif
        </h4>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 my-4">
        <i>Maxsulot xaqida:</i>
        <h4>{{ $product->description }}</h4>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 my-4">
        <i>Kelgan sana:</i>
        <h4>{{ $product->created_at }}</h4>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 my-4 d-flex justify-content-end">
        <a href="{{ route('products.form',$product->id) }}" class="btn btn-primary">Taxrirlash</a>
        <a href="{{ route('products.deletePage',$product->id) }}" class="btn btn-danger mx-1">O'chirish</a>
        <a href="{{ route('products.index') }}" class="btn btn-primary">Orqaga</a>
    </div>
</div>
@endsection