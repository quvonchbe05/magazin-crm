@extends('layouts.app')
@section('title',"To'liq")
@section('content__title')
{{ $worker->fish }} xaqida to'liq ma'lumot:
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
    <div class="col-lg-2 col-ma-6 col-sm-12 ">
        <img src="{{ asset($worker->img_path) }}" class="img-fluid rounded" alt="IMG">
    </div>
    <div class="col-lg-8 col-ma-6 col-sm-12">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 my-4">
                <i>F.I.SH.:</i>
                <h4>{{ $worker->fish }}</h4>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 my-4">
                <i>Telefon 1:</i>
                <h4>{{ $worker->phone1 }}</h4>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 my-4">
                <i>Telefon 2:</i>
                <h4>
                    @if($worker->phone2)
                    {{ $worker->phone2 }}
                    @else
                    Mavjud emas
                    @endif
                </h4>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 my-4">
                <i>Lavozimi:</i>
                <h4>{{ $worker->role->role_name }}</h4>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 my-4">
                <i>Tug'ilgan sana:</i>
                <h4>{{ $worker->t_sana }}</h4>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 my-4">
                <i>Ishga kelgan sana:</i>
                <h4>{{ $worker->kelgan_sana }}</h4>
            </div>
        </div>
    </div>
</div>
<div class="row mx-3">
    
    <div class="col-lg-4 col-md-6 col-sm-12 my-4">
        <i>Email:</i>
        <h4>{{ $worker->email }}</h4>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12">
        <i>Ishchi xaqida qisqacha:</i>
        <h4>{{ $worker->description }}</h4>
    </div>
    <div class="col-lg-2 col-md-12 col-sm-12 d-flex justify-content-center align-items-center">
        <a href="{{ route('register.updatePage',$worker->id) }}" class="btn btn-primary w-100">Taxrirlash</a>
        <a href="{{ route('register.deletePage',$worker->id) }}" class="btn btn-danger mx-1 w-100">O'chirish</a>
        <a href="{{ route('register.index') }}" class="btn btn-primary w-100">Orqaga</a> 
    </div>
</div>
@endsection