@extends('layouts.app')
@section('title',"Maxsulotni taxrirlash")
@section('content__title')
Maxsulot xaqida to'liq ma'lumot
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
    <div class="col-lg-4 col-md-6 col-sm-12 my-4">
        <i>Nomi:</i>
        <h4>{{ $product->name }}</h4>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 my-4">
        <i>Kategoriya:</i>
        <h4>{{ $product->category->cat_name }}</h4>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 my-4">
        <i>Soni/Kg:</i>
        <h4>{{ $product->amount }}</h4>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 my-4">
        <i>Asl narxi:</i>
        <h4>{{ $product->original_price }}</h4>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 my-4">
        <i>Sotiladigan narxi:</i>
        <h4>{{ $product->sale_price }}</h4>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 my-4">
        <i>Saqlash muddati:</i>
        <h4>
            @if ($product->deadLine)
                {{ $product->deadLine }}
            @else
                Mavjud emas
            @endif
        </h4>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 my-4">
        <i>Maxsulotni qabul qilgan xodim:</i>
        <h4>{{ $product->worker->fish }}</h4>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 my-4">
        <i>Maxsulot xaqida:</i>
        <h4>{{ $product->description }}</h4>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 my-4">
        <i>Kelgan sana:</i>
        <h4>{{ $product->created_at }}</h4>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 my-4 d-flex justify-content-end">
        <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#deleteusermodal{{ $product->id }}"><i class="far fa-trash-alt"></i></button>
        <!-- Delete User Modal -->
            <div class="modal fade" id="deleteusermodal{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Maxsulotni o'chirish</h4>
                        </div>
                        <div class="modal-body">
                            <h3 class="text-danger">Siz rostdanxam {{ $product->fish }}ni o'chirib tashlamoqchimisiz!</h3>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Orqaga</button>
                            <a href="{{ route('products.delete',$product->id) }}" class="btn btn-primary">O'chirish</a>
                        </div>
                    </div>
                </div>
            </div>
        <!-- End Delete User Modal -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addusermodal"><i class="far fa-edit"></i></button>
        <a href="{{ route('products.index') }}" class="btn btn-primary">Orqaga</a>
    </div>
</div>
<!-- Update Product Modal -->
<form action="{{ route('products.update',$product->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="modal fade" id="addusermodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Maxsulotni taxrirlash</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nomi</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Maxsulot nomini kiriting..." value="{{ $product->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Soni/Kg</label>
                        <input type="number" class="form-control" id="amount" name="amount"
                            placeholder="Soni yoki Kgni kiriting..." value="{{ $product->amount }}" required>
                    </div>
                    <div class="form-group">
                        <label for="original_price">Asl narxi</label>
                        <input type="number" class="form-control" id="original_price" name="original_price"
                            placeholder="Maxsulotning asl narxi..." value="{{ $product->original_price }}" required>
                    </div>
                    <div class="form-group">
                        <label for="sale_price">Sotiladigan narxi</label>
                        <input type="number" class="form-control" id="sale_price" name="sale_price"
                            placeholder="Maxsulotning sotiladigan narxi..." value="{{ $product->sale_price }}" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Kategoriyasi</label>
                        <select class="form-control" id="category" name="cat_id"
                            required>
                            <option value="">----</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected($category->id == $product->cat_id)>
                                {{ $category->cat_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deadLine">Saqlash muddati (Ixtiyoriy)</label>
                        <input type="date" class="form-control" id="deadLine" name="deadLine"
                            value="{{ old('deadLine') }}">
                    </div>
                    <div class="form-group">
                        <label for="postedBy">Maxsulotni qabul qilgan xodim</label>
                        <select name="postedBy" id="postedBy" class="form-control">
                            <option value="">----</option>
                            @foreach ($workers as $worker)
                            <option value="{{ $worker->id }}" @selected($worker->id == $product->postedBy)>
                                {{ $worker->fish }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Qo'shimcha ma'lumot</label>
                        <textarea name="description" class="form-control" id="description" rows="4"
                            placeholder="Maxsulot xaqida qo'shimcha ma'lumot">{{  $product->description  }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Orqaga</button>
                    <button type="submit" class="btn btn-primary">Taxrirlash</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Update Product Modal -->
@endsection 