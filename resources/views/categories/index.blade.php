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
<table class="table table-bordered table-responsive-lg">
    <thead class="thead-dark">
        <tr>
            <th scope="col">№</th>
            <th scope="col">Nomi</th>
            <th scope="col">
                <button class="btn btn-light w-100" data-bs-toggle="modal" data-bs-target="#addcategorymodal"><i
                        class="fas fa-plus mr-1"></i> Qo'shish</button>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $category->cat_name }}</td>
            <td class="d-flex">
                <button class="btn btn-primary w-100" data-bs-toggle="modal"
                    data-bs-target="#updatecategory{{ $category->id }}"><i class="far fa-edit"></i></button>
                <!-- Update Category Modal -->
                <form action="{{ route('categories.update',$category->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal fade" id="updatecategory{{ $category->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel">Kategoriyani taxrirlash</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="cat_name">Nomi</label>
                                        <input type="text" class="form-control" id="cat_name" name="cat_name"
                                            placeholder="Kategoriya nomini kiriting..."
                                            value="{{ $category->cat_name }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Orqaga</button>
                                    <button type="submit" class="btn btn-primary">Taxrirlash</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Update Add Category Modal -->
                <button class="btn btn-primary w-100" data-bs-toggle="modal"
                data-bs-target="#deletecategory{{ $category->id }}"><i class="far fa-trash-alt"></i></button>
            <!-- Delete Category Modal -->
            <div class="modal fade" id="deletecategory{{ $category->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Kategoriyani o'chirish</h4>
                            </div>
                            <div class="modal-body">
                                <h3 class="text-danger">Siz rostdanxam {{ $category->fish }}ni o'chirib tashlamoqchimisiz!</h3>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Orqaga</button>
                                <a href="{{ route('categories.delete',$category->id) }}" class="btn btn-primary">Taxrirlash</a>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- Delete Add Category Modal -->
           
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!-- Add Category Modal -->
<form action="{{ route('categories.add') }}" method="post">
    @csrf
    <div class="modal fade" id="addcategorymodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Yangi kategoriya qo'shish</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="cat_name">Nomi</label>
                        <input type="text" class="form-control" id="cat_name" name="cat_name"
                            placeholder="Kategoriya nomini kiriting..." value="{{ old('cat_name') }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Orqaga</button>
                    <button type="submit" class="btn btn-primary">Qo'shish</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Add Category Modal -->
@endsection