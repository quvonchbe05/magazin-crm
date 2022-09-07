@extends('layouts.app')
@section('title', 'Kategoriyalar')
@section('content__title')
Kategoriyalar jadvali
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
<div class="d-flex justify-content-end pb-3">
    <a href="{{ route('categories.addForm') }}" class="btn btn-dark">Qo'shish</a>
</div>
<table class="table table-bordered table-responsive-lg">
    <thead class="thead-dark">
        <tr>
            <th scope="col">№</th>
            <th scope="col">Nomi</th>
            <th scope="col">
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $category->cat_name }}</td>
            <td class="d-flex">
                <a href="{{ route('categories.updateForm',$category->id) }}" class="btn btn-primary mr-1 w-25">Taxrirlash</a>
                <a href="{{ route('categories.deletePage',$category->id) }}" class="btn btn-danger w-25">O'chirish</a>           
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection