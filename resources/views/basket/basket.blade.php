@extends('layouts.app')
@section('title', 'Savat ')
@section('content__title')
Savat
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
                <th scope="col">Kategoriyasi</th>
                <th scope="col">Qolgan soni</th>
                <th scope="col">Soni</th>
                <th scope="col">Sotiladigan narxi</th>
                <th scope="col">Summa</th>
                <th scope="col">
                    <a href="{{ route('basket.removeBasket') }}" class="btn btn-light w-100"><i class="fas fa-sync-alt mx-2"></i>Savatni bo'shatish</a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $product->products->name }}</td>
                <td>{{ $product->products->category->cat_name }}</td>
                <td>{{ $product->products->amount }}</td>
                <form action="{{ route('basket.basketRefresh',$product->id) }}" method="post">
                    @csrf
                    <input type="hidden" value="{{ $product->id }}">
                <td>
                    <input type="number" class="form-control" name="product_count"
                    value="{{ $product->product_count }}">
                </td>
                    <td>
                        <input type="number" class="form-control" name="product_price"
                            value="{{ $product->product_price }}">
                    </td>
                    <td>
                        {{ $product->summa }}
                    </td>
                    <td><button type="submit" class="btn btn-primary w-100"><i class="fas fa-sync-alt"></i></td>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-between">
        <h1>Umumiy narx: {{ $summa }}</h1>
        <div>
            <a href="{{ route('basket.saveToSaled') }}" class="btn btn-primary"><i class="fas fa-shopping-cart mx-1"></i>Sotish</a>
        </div>
    </div>
@endsection