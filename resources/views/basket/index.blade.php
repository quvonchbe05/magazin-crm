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
<table class="table table-bordered table-responsive-lg">
    <thead class="thead-dark">
        <tr>
            <th scope="col">№</th>
            <th scope="col">Nomi</th>
            <th scope="col">Soni</th>
            <th scope="col">Kategoriyasi</th>
            <th scope="col">Sotiladigan narxi</th>
            <th scope="col">Saqlash muddati</th>
            <th scope="col" colspan="2">Savatga to'plash</th>
            <th scope="col">Yakka xolda sotish</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $product->name }}</td>
            <td>{{ $product->amount }}</td>
            <td>{{ $product->category->cat_name }}</td>
            <td>{{ $product->sale_price }}</td>
            <td>
                @if($product->deadLine)
                {{ $product->deadLine }}
                @else
                Mavjud emas
                @endif
            </td>
            <form action="{{ route('basket.toBasket',$product->id) }}" method="post">
                @csrf
                <td>
                    <input type="number" class="form-control w-100" placeholder="Soni..." name="product_count">
                </td>
                <td>
                    <button type="submit" class="btn btn-primary w-100">Ok</button>
                </td>
            </form>
            <td><a href="{{ route('basket.sale',$product->id) }}" class="btn btn-primary w-100"><i class="fas fa-shopping-cart"></i></a> </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $products->links() }}
</div>
@endsection