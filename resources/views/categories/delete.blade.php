@extends('layouts.app')
@section('title', 'Kategoriyalar')
@section('content__title')
Kategoriyani o'chirish
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
<h1 class="text-danger">Siz rostdanxam {{ $category->cat_name }}ni o'chirishni xoxlaysizmi!</h1>
<div class="d-flex justify-content-end">
    <a href="{{ route('categories.index') }}" class="btn btn-primary mr-2">Orqaga</a>
    <a href="{{ route('categories.delete',$category->id) }}" class=" btn btn-danger">O'chirish</a>
</div>
@endsection