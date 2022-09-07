@extends('layouts.app')
@section('title',"Maxsulotni taxrirlash")
@section('content__title')
Maxsulotni o'chirib tashlash
@endsection
@section('content')
    <h1 class="text-danger">
        Siz rostdanxam {{ $product->name }}ni o'chirishni xoxlaysizmi?
    </h1>
    <div class="d-flex justify-content-end">
        <a href="{{ route('products.index') }}" class="btn btn-primary mx-1">Yo'q</a>
        <a href="{{ route('products.delete',$product->id) }}" class="btn btn-danger">Xa</a>
    </div>
@endsection