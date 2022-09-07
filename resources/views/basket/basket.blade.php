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
<div class="d-flex justify-content-end pb-3">
    <a href="{{ route('basket.removeBasket') }}" class="btn btn-primary">Savatni bo'shatish</a>
</div>
<table class="table table-bordered table-responsive-lg">
    <thead class="thead-dark">
        <tr>
            <th scope="col">№</th>
            <th scope="col">Nomi</th>
            <th scope="col">Kategoriyasi</th>
            <th scope="col">Qolgan soni</th>
            <th scope="col">Asl narxi</th>
            <th scope="col">Soni</th>
            <th scope="col">Sotiladigan narxi</th>
            <th scope="col">Summa</th>
            <th scope="col">
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        @if (isset($product->products->name))
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $product->products->name }}</td>
            <td>
                @if (isset($product->products->category->cat_name))
                {{ $product->products->category->cat_name }}
                @else
                <span class="text-danger">O'chirilib yuborilgan</span>
                @endif
            </td>
            </td>
            <td>{{ $product->products->amount }}</td>
            <td>{{ number_format($product->products->original_price) }}</td>
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
                    {{ number_format($product->summa) }}
                </td>
                <td class="d-flex">
                    <button type="submit" class="btn btn-primary w-100 mr-1">Yangilash</button>
                    <a href="{{ route('basket.deleteOnTheBasket',$product->id) }}" class="btn btn-danger w-100">O'chirish</a>
                </td>
            </form>
        </tr>
        @else
        <tr>
            <td colspan="8">
                <h4 class="text-danger text-center">Maxsulot bazada mavjud emas!</h4>
            </td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-between">
    <h1>Umumiy narx: @if (isset($product->products->name))
        {{ number_format($summa) }}
        @else
        0
        @endif
    </h1>
    <div>
        <a href="{{ route('basket.saveToSaled') }}" class="btn btn-primary"><i
                class="fas fa-shopping-cart mx-1"></i>Sotish</a>
    </div>
</div>
@endsection