@extends('layouts.app')
@section('title',"Maxsulotni taxrirlash")
@section('content__title')
Maxsulot xaqida to'liq ma'lumot
@endsection
@section('content')
    <h1 class="text-danger">
        Siz rostdanxam {{ $product->name }}ni o'chirishni xoxlaysizmi?
    </h1>
    <div class="d-flex justify-content-end">
        <a href="{{ route('products.index') }}" class="btn btn-primary">Yo'q</a>
        <a href="{{ route('products.delete',$product->id) }}" class="btn btn-primary">Xa</a>
    </div>
@endsection