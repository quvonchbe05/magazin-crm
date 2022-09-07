@extends('layouts.app')
@section('title',"Maxsulot qo'shish")
@section('content__title', 'Maxsulot qo\'shish')
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
<form action="{{ route('products.create') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 my-4">
            <label for="name">Nomi</label>
            <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name" required>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 my-4">
            <label for="category">Kategoriyasi</label>
            <select class="form-control" id="category" name="cat_id" required>
                <option value="">----</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected($category->id == old('cat_id'))>
                    {{ $category->cat_name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 my-4">
            <label for="amount">Soni/Kg</label>
            <input type="number" class="form-control" value="{{ old('amount') }}" id="amount" name="amount" required>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 my-4">
            <label for="original_price">Asl narxi</label>
            <input type="number" class="form-control" value="{{ old('original_price') }}" id="original_price"
                name="original_price" required>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 my-4">
            <label for="sale_price">Sotiladigan narxi</label>
            <input type="number" class="form-control" value="{{ old('sale_price') }}" id="sale_price"
                name="sale_price" required>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 my-4">
            <label for="deadLine">Saqlash muddati</label>
            <input type="date" class="form-control" value="{{ old('deadLine') }}" id="deadLine" name="deadLine">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 my-4">
            <label for="postedBy">Maxsulotni qabul qilgan xodim</label>
            <select name="postedBy" id="postedBy" class="form-control" required>
                <option value="">----</option>
                @foreach ($workers as $worker)
                <option value="{{ $worker->id }}" @selected($worker->id == old('postedBy'))>
                    {{ $worker->fish }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 my-4  ">
            <label for="description">Qo'shimcha ma'lumot</label>
            <textarea name="description" class="form-control" id="description" rows="4"
                placeholder="Maxsulot xaqida qo'shimcha ma'lumot" required>{{ old('description') }}</textarea>
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <a href="{{ route('products.index') }}" class="btn btn-primary my-4 mx-1">Orqaga</a>
        <button type="submit" class="btn btn-primary my-4">Qo'shish</button>
    </div>
</form>
@endsection