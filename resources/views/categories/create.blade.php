@extends('layouts.app')
@section('title', 'Kategoriyalar')
@section('content__title')
Kategoriya qo'shish
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
<form action="{{ route('categories.add') }}" method="POST" class="text-center">
    @csrf
    <label for="">Iltimos kategoriya nomini kiriting:</label>
    <div class="d-flex justify-content-center py-3">
        <input type="text" class="form-control w-50" placeholder="Kategoriya nomi..." value="{{ old('cat_name') }}" name="cat_name" required>
        <button type="submit" class="btn btn-primary">Qo'shish</button>
    </div>
    <a href="{{ route('categories.index') }}" class="btn btn-danger">Orqaga</a>
</form>
@endsection