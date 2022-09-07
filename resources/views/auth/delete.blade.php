@extends('layouts.app')
@section('title',"Maxsulotni taxrirlash")
@section('content__title')
Xodimni o'chirib tashlash
@endsection
@section('content')
    <h1 class="text-danger">
        Siz rostdanxam {{ $worker->fish }}ni o'chirishni xoxlaysizmi?
    </h1>
    <div class="d-flex justify-content-end">
        <a href="{{ route('register.index') }}" class="btn btn-primary mx-1">Yo'q</a>
        <a href="{{ route('register.delete',$worker->id) }}" class="btn btn-danger">Xa</a>
    </div>
@endsection