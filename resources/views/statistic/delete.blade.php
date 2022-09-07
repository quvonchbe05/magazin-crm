@extends('layouts.app')
@section('title',"Maxsulotni taxrirlash")
@section('content__title')
Xisobotni o'chirib tashlash
@endsection
@section('content')
<h1 class="text-danger">
    @if (isset($saled->products->name))
    Siz rostdanxam {{ $saled->products->name }}ni o'chirishni xoxlaysizmi?
    @else
    Siz rostdanxam shu xisobotni o'chirishni xoxlaysizmi?
    @endif
</h1>
<div class="d-flex justify-content-end">
    <a href="{{ route('statistic.index') }}" class="btn btn-primary mx-1">Yo'q</a>
    <a href="{{ route('statistic.delete',$saled->id) }}" class="btn btn-danger">Xa</a>
</div>
@endsection