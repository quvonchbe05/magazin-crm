@extends('layouts.app')
@section('title', 'Sotuv bo\'limi')
@section('content__title')
Sotuv bo'limi
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
<div class="row py-4">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <form action="{{ route('basket.search') }}">
            <label for="" class="text-muted">Nomi bo'yicha qidiruv:</label>
            <div class="d-flex">
                <input type="text" class="form-control w-100" placeholder="Nomi bo'yicha qidiruv..." id="productSearch"
                    value="@if (isset($_GET['name'])){{ $_GET['name'] }}@endif" name="name">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <form action="{{ route('basket.filter') }}">
            <label for="" class="text-muted">Kategoriya bo'yicha saralsh:</label>
            <div class="d-flex">
                <select name="category" class="form-control" id="productFilter">
                    <option value="">Jami maxsulot</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
</div>
<div class="d-flex justify-content-center">
    <a href="{{ route('basket.basket') }}" class="btn btn-primary mb-3 position-relative">
        Savat
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ $amount }}
        </span>
    </a>
</div>
<table class="table table-bordered table-responsive-lg">
    <thead class="thead-dark">
        <tr>
            <th scope="col">№</th>
            <th scope="col">Nomi</th>
            <th scope="col">Soni</th>
            <th scope="col">Kategoriyasi</th>
            <th scope="col">Asl narxi</th>
            <th scope="col">Sotiladigan narxi</th>
            <th scope="col">Saqlash muddati</th>
            <th scope="col">Savatga to'plash</th>
            <th scope="col">Yakka xolda sotish</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $product->name }}</td>
            <td>{{ $product->amount }}</td>
            <td> @if (isset($product->category->cat_name))
                {{ $product->category->cat_name }}
                @else
                <span class="text-danger">O'chirilib yuborilgan</span>
                @endif
            </td>
            <td>{{ number_format($product->original_price) }}</td>
            <td>{{ number_format($product->sale_price) }}</td>
            <td>
                @if($product->deadLine)
                {{ $product->deadLine }}
                @else
                Mavjud emas
                @endif
            </td>
            <form action="{{ route('basket.toBasket',$product->id) }}" method="post">
                @csrf
                <td class="d-flex">
                    <input type="number" class="form-control w-100" placeholder="Soni..." name="product_count"
                        value="1">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-cart-arrow-down"></i></button>
                </td>
            </form>
            <td><a href="{{ route('basket.sale',$product->id) }}" class="btn btn-primary w-100"><i
                        class="fas fa-shopping-cart"></i></a> </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $products->links() }}
</div>
@endsection