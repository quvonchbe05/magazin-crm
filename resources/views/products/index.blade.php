@extends('layouts.app')
@section('title',"Maxsulotlar")
@section('content__title')
Maxsulotlar ro'yxati
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
            <th scope="col">Soni</th>
            <th scope="col">Kategoriyasi</th>
            <th scope="col">Olingan narxi</th>
            <th scope="col">Sotiladigan narxi</th>
            <th scope="col">Saqlash muddati</th>
            <th scope="col">
                <button class="btn btn-light w-100" data-bs-toggle="modal" data-bs-target="#addusermodal"><i
                        class="fas fa-plus mr-1"></i> Qo'shish</button>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $product->name }}</td>
            <td>{{ $product->amount }}</td>
            <td>{{ $product->category->cat_name }}</td>
            <td>{{ $product->original_price }}</td>
            <td>{{ $product->sale_price }}</td>
            <td>
                @if($product->deadLine)
                {{ $product->deadLine }}
                @else
                Mavjud emas
                @endif
            </td>
            <td class="d-flex">
               <a href="{{ route('products.form',$product->id) }}" class="btn btn-primary w-100"><i class="far fa-edit"></i></a> 
                <a href="{{ route('products.show',$product->id) }}" class="btn btn-primary w-100"><i
                        class="fas fa-eye"></i></a>
                <a href="{{ route('products.deletePage',$product->id) }}" class="btn btn-primary w-100"><i class="far fa-trash-alt"></i></a> 
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $products->links() }}
</div>
<!-- Add Product Modal -->
<form action="{{ route('products.create') }}" method="post">
    @csrf
    <div class="modal fade" id="addusermodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Yangi maxsulot qo'shish</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nomi</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Maxsulot nomini kiriting..." value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Soni/Kg</label>
                        <input type="number" class="form-control" id="amount" name="amount"
                            placeholder="Soni yoki Kgni kiriting..." value="{{ old('amount') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="original_price">Asl narxi</label>
                        <input type="number" class="form-control" id="original_price" name="original_price"
                            placeholder="Maxsulotning asl narxi..." value="{{ old('original_price') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="sale_price">Sotiladigan narxi</label>
                        <input type="number" class="form-control" id="sale_price" name="sale_price"
                            placeholder="Maxsulotning sotiladigan narxi..." value="{{ old('sale_price') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Kategoriyasi</label>
                        <select class="form-control" id="category" name="cat_id" value="{{ old('category') }}"
                            required>
                            <option value="">----</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
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
                            <option value="{{ $worker->id }}" @selected($worker->id == old('postedBy'))>
                                {{ $worker->fish }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Qo'shimcha ma'lumot</label>
                        <textarea name="description" class="form-control" id="description" rows="4"
                            placeholder="Maxsulot xaqida qo'shimcha ma'lumot">{{  old('description')  }}</textarea>
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
<!-- End Add Product Modal -->
@endsection