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
<div class="row py-4">
    <div class="col-lg-5 col-md-5 col-sm-12">
        <input type="text" class="form-control" placeholder="Nomi bo'yicha qidiruv..." id="productSearch">
    </div>
    <div class="col-lg-5 col-md-5 col-sm-12">
        <select name="" class="form-control" id="productFilter">
            <option value="">Jami maxsulot</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-2  col-md-2 col-sm-12">
        <a href="{{ route('products.addForm') }}" class="btn btn-dark w-100">Qo'shish</a>
    </div>
</div>
<table class="table table-bordered table-responsive-lg">
    <thead class="thead-dark">
        <tr>
            <th scope="col">№</th>
            <th scope="col">Nomi</th>
            <th scope="col">Soni
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-dark" id="desc"><i class="fas fa-arrow-up"></i></button>
                    <button type="button" class="btn btn-dark" id="asc"><i class="fas fa-arrow-down"></i></button>
                </div>
            </th>
            <th scope="col">Kategoriyasi</th>
            <th scope="col">Olingan narxi</th>
            <th scope="col">Sotiladigan narxi</th>
            <th scope="col">Saqlash muddati</th>
            <th scope="col">
            </th>
        </tr>
    </thead>
    <tbody id="productTbody">
        @foreach ($products as $product)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $product->name }}</td>
            <td class="@if ($product->amount <= 10)
                bg-danger
            @elseif ($product->amount <= 50)
                bg-warning
            @else
                bg-success
            @endif">{{ $product->amount }}</td>
            <td>
                @if (isset($product->category->cat_name))
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
                <span class="text-danger">Mavjud emas</span>
                @endif
            </td>
            <td class="d-flex">
                <a href="{{ route('products.form',$product->id) }}" class="btn btn-primary w-100">Taxrirlash</a>
                <a href="{{ route('products.show',$product->id) }}" class="btn btn-warning w-100 mx-1">Ko'rish</a>
                <a href="{{ route('products.deletePage',$product->id) }}" class="btn btn-danger w-100">O'chirish</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $products->links() }}
</div>
@section('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // Nomi bo'yicha qidiruv
    $('#productSearch').keyup(function () {
        $.ajax({
            type:'POST',
            url:"{{ route('products.searchProduct') }}",
            data:{name:$('#productSearch').val()},
            success:function(response){
                $('#productTbody').html('');
                $.each(response.products, function(index, value){
                    let loop = index + 1;
                    let date = value.deadLine == null ? "<span class='text-danger'>Mavjud emas</span>" : value.deadLine;
                    let category = value.cat_name == null ? "<span class='text-danger'>O'chirilib yuborilgan</span>" : value.cat_name;
                    function color(e){
                        if(e<=10){
                            return "bg-danger"
                        } else if(e<=50){
                            return "bg-warning"
                        } else{
                            return "bg-success"
                        }
                    }
                    $('#productTbody').append(
                        '<tr>'+
                            '<th scope="row">'+loop+'</th>'+
                            '<td>'+value.name+'</td>'+
                            '<td class='+color(value.amount)+'>'+value.amount+'</td>'+
                            '<td>'+category+'</td>'+
                            '<td>'+value.original_price+'</td>'+
                            '<td>'+value.sale_price+'</td>'+
                            '<td>'+date+'</td>'+
                            '<td class="d-flex action-buttons">'+
                                '<a href="products/form/'+value.id+'" class=\'btn btn-primary w-100\'>Taxrirlash</a>'+
                                '<a href="products/show/'+value.id+'" class=\'btn btn-warning w-100 mx-1\'>Ko\'rish</a>'+
                                '<a href="products/deletePage/'+value.id+'" class=\'btn btn-danger w-100\'>O\'chirish</a>'+
                            '</td>'+
                        '</tr>'
                    );
                });
           }
        });
    });


        // Kategoriya bo'yicha saralash
        $('#productFilter').change(function () {
        $.ajax({
            type:'POST',
            url:"{{ route('products.filterByCategory') }}",
            data:{cat_id:$('#productFilter').val()},
            success:function(response){
                $('#productTbody').html('');
                $.each(response.products, function(index, value){
                    let loop = index + 1;
                    let date = value.deadLine == null ? "<span class='text-danger'>Mavjud emas</span>" : value.deadLine;
                    let category = value.cat_name == null ? "<span class='text-danger'>O'chirilib yuborilgan</span>" : value.cat_name;
                    function color(e){
                        if(e<=10){
                            return "bg-danger"
                        } else if(e<=50){
                            return "bg-warning"
                        } else{
                            return "bg-success"
                        }
                    }
                    $('#productTbody').append(
                        '<tr>'+
                            '<th scope="row">'+loop+'</th>'+
                            '<td>'+value.name+'</td>'+
                            '<td class='+color(value.amount)+'>'+value.amount+'</td>'+
                            '<td>'+category+'</td>'+
                            '<td>'+value.original_price+'</td>'+
                            '<td>'+value.sale_price+'</td>'+
                            '<td>'+date+'</td>'+
                            '<td class="d-flex action-buttons">'+
                                '<a href="products/form/'+value.id+'" class=\'btn btn-primary w-100\'>Taxrirlash</a>'+
                                '<a href="products/show/'+value.id+'" class=\'btn btn-warning w-100 mx-1\'>Ko\'rish</a>'+
                                '<a href="products/deletePage/'+value.id+'" class=\'btn btn-danger w-100\'>O\'chirish</a>'+
                            '</td>'+
                        '</tr>'
                    );
                });
           }
        });
    });


        // Sort Desc bo'yicha qidiruv
        $('#desc').click(function () {
        $.ajax({
            type:'POST',
            url:"{{ route('products.sortDesc') }}",
            data:{},
            success:function(response){
                $('#productTbody').html('');
                $.each(response.products, function(index, value){
                    let loop = index + 1;
                    let date = value.deadLine == null ? "<span class='text-danger'>Mavjud emas</span>" : value.deadLine;
                    let category = value.cat_name == null ? "<span class='text-danger'>O'chirilib yuborilgan</span>" : value.cat_name;
                    function color(e){
                        if(e<=10){
                            return "bg-danger"
                        } else if(e<=50){
                            return "bg-warning"
                        } else{
                            return "bg-success"
                        }
                    }
                    $('#productTbody').append(
                        '<tr>'+
                            '<th scope="row">'+loop+'</th>'+
                            '<td>'+value.name+'</td>'+
                            '<td class='+color(value.amount)+'>'+value.amount+'</td>'+
                            '<td>'+category+'</td>'+
                            '<td>'+value.original_price+'</td>'+
                            '<td>'+value.sale_price+'</td>'+
                            '<td>'+date+'</td>'+
                            '<td class="d-flex action-buttons">'+
                                '<a href="products/form/'+value.id+'" class=\'btn btn-primary w-100\'>Taxrirlash</a>'+
                                '<a href="products/show/'+value.id+'" class=\'btn btn-warning w-100 mx-1\'>Ko\'rish</a>'+
                                '<a href="products/deletePage/'+value.id+'" class=\'btn btn-danger w-100\'>O\'chirish</a>'+
                            '</td>'+
                        '</tr>'
                    );
                });
           }
        });
    });


            // Sort Asc bo'yicha qidiruv
            $('#asc').click(function () {
        $.ajax({
            type:'POST',
            url:"{{ route('products.sortAsc') }}",
            data:{},
            success:function(response){
                $('#productTbody').html('');
                $.each(response.products, function(index, value){
                    let loop = index + 1;
                    let date = value.deadLine == null ? "<span class='text-danger'>Mavjud emas</span>" : value.deadLine;
                    let category = value.cat_name == null ? "<span class='text-danger'>O'chirilib yuborilgan</span>" : value.cat_name;
                    function color(e){
                        if(e<=10){
                            return "bg-danger"
                        } else if(e<=50){
                            return "bg-warning"
                        } else{
                            return "bg-success"
                        }
                    }
                    $('#productTbody').append(
                        '<tr>'+
                            '<th scope="row">'+loop+'</th>'+
                            '<td>'+value.name+'</td>'+
                            '<td class='+color(value.amount)+'>'+value.amount+'</td>'+
                            '<td>'+category+'</td>'+
                            '<td>'+value.original_price+'</td>'+
                            '<td>'+value.sale_price+'</td>'+
                            '<td>'+date+'</td>'+
                            '<td class="d-flex action-buttons">'+
                                '<a href="products/form/'+value.id+'" class=\'btn btn-primary w-100\'>Taxrirlash</a>'+
                                '<a href="products/show/'+value.id+'" class=\'btn btn-warning w-100 mx-1\'>Ko\'rish</a>'+
                                '<a href="products/deletePage/'+value.id+'" class=\'btn btn-danger w-100\'>O\'chirish</a>'+
                            '</td>'+
                        '</tr>'
                    );
                });
           }
        });
    });
</script>
@endsection
@endsection