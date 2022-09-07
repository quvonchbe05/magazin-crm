@extends('layouts.app')
@section('title',"Xisobot")
@section('content__title',"Xisobot")
@section('content')
<div class="row justify-content-around">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-5 alert alert-info">
            <h1 class="p-5" id="sumday"><small class="text-muted">Umumiy summa: </small>{{ number_format($sumday) }}
                so'm</h1>
        </div>
    </div>
</div>
<div class="d-flex justify-content-end">
    <a href="{{ route('statistic.index') }}" class="btn btn-primary mb-3">Orqaga</a>
</div>
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
            <th scope="col">Asl narxi</th>
            <th scope="col">Summa</th>
            <th scope="col">Sana</th>
            <th scope="col">Sotgan xodim</th>
            @can('admin')                
            <th scope="col"></th>
            @endcan
            @can('direktor')                
            <th scope="col"></th>
            @endcan
        </tr>
    </thead>
    <tbody id="basketTbody">
        @foreach ($saleds as $saled)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            @if (isset($saled->products->name))
            <td>{{ $saled->products->name }}</td>
            @else
            <td><span class="text-danger">O'chirilib yuborilgan</span></td>
            @endif
            <td>{{ $saled->product_count }}</td>
            <td>
                @if (isset($saled->products->category->cat_name))
                {{ $saled->products->category->cat_name }}
                @else
                <span class="text-danger">O'chirilib yuborilgan</span>
                @endif
            </td>
            <td>{{ number_format($saled->product_price) }}</td>
            <td>{{ number_format($saled->original_price) }}</td>
            <td>{{ number_format($saled->summa) }}</td>
            <td>{{ $saled->created_at }}</td>
            <td>
                @if (!isset($saled->worker->fish) || $saled->worker->fish == null)
                <span class="text-danger">O'chirilib yuborilgan</span>
                @else
                {{ $saled->worker->fish }}
                @endif
            </td>
            @can('admin')                
            <td class="d-flex justify-content-center">
                <a href="{{ route('statistic.qayta',$saled->id) }}" class="btn btn-primary mx-1">Qayta</a>
                <a href="{{ route('statistic.deletePage',$saled->id) }}" class="btn btn-danger">O'chirish</a>
            </td>
            @endcan
            @can('direktor')                
            <td class="d-flex justify-content-center">
                <a href="{{ route('statistic.qayta',$saled->id) }}" class="btn btn-primary mx-1">Qayta</a>
                <a href="{{ route('statistic.deletePage',$saled->id) }}" class="btn btn-danger">O'chirish</a>
            </td>
            @endcan
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $saleds->links() }}
</div>
{{-- @section('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // date bo'yicha qidiruv
    $('#date').change(function () {
        $.ajax({
            type:'POST',
            url:"{{ route('statistic.filterByDate') }}",
            data:{
                date:$('#date').val(),
                worker_id:$('#worker').val(),
            },
            success:function(response){
                console.log(response);
                $('#basketTbody').html('');
                $('#sumday').html('<small class="text-muted">Kunlik summa: </small>'+response.sumday+' so\'m');
                $('#summonth').html('<small class="text-muted">Oylik summa: </small>'+response.summonth+' so\'m');
                $.each(response.saleds, function(index, value){
                    let loop = index + 1;
                    let name = value.name === null ? "<span class='text-danger'>O'chirib yuborilgan</span>" : value.name;
                    let category = value.cat_name === null ? "<span class='text-danger'>O'chirib yuborilgan</span>" : value.cat_name;
                    let worker = value.fish === null ? "<span class='text-danger'>O'chirib yuborilgan</span>" : value.fish;
                    $('#basketTbody').append(
                        '<tr>'+
                            '<th scope="row">'+loop+'</th>'+
                            '<td>'+name+'</td>'+
                            '<td>'+value.product_count+'</td>'+
                            '<td>'+category+'</td>'+
                            '<td>'+value.product_price+'</td>'+
                            '<td>'+value.original_price+'</td>'+
                            '<td>'+value.summa+'</td>'+
                            '<td>'+value.created_at.slice(0,10)+' '+value.created_at.slice(11,19)+'</td>'+
                            '<td>'+worker+'</td>'+
                            '<td class="d-flex action-buttons">'+
                                '<a href="statistic/qayta/'+value.id+'" class=\'btn btn-primary w-100 mx-1\'>Qayta</a>'+
                                '<a href="statistic/deletePage/'+value.id+'" class=\'btn btn-danger w-100\'>O\'chirish</a>'+
                            '</td>'+
                        '</tr>'
                    );
                });
           }
        });
    });

        // Xodim bo'yicha qidiruv
        $('#worker').change(function () {
        $.ajax({
            type:'POST',
            url:"{{ route('statistic.filterByDate') }}",
            data:{
                date:$('#date').val(),
                worker_id:$('#worker').val(),
            },
            success:function(response){
                console.log(response);
                $('#basketTbody').html('');
                $('#sumday').html('<small class="text-muted">Kunlik summa: </small>'+response.sumday+' so\'m');
                $('#summonth').html('<small class="text-muted">Oylik summa: </small>'+response.summonth+' so\'m');
                $.each(response.saleds, function(index, value){
                    let loop = index + 1;
                    let name = value.name === null ? "<span class='text-danger'>O'chirib yuborilgan</span>" : value.name;
                    let category = value.cat_name === null ? "<span class='text-danger'>O'chirib yuborilgan</span>" : value.cat_name;
                    let worker = value.fish === null ? "<span class='text-danger'>O'chirib yuborilgan</span>" : value.fish;
                    $('#basketTbody').append(
                        '<tr>'+
                            '<th scope="row">'+loop+'</th>'+
                            '<td>'+name+'</td>'+
                            '<td>'+value.product_count+'</td>'+
                            '<td>'+category+'</td>'+
                            '<td>'+value.product_price+'</td>'+
                            '<td>'+value.original_price+'</td>'+
                            '<td>'+value.summa+'</td>'+
                            '<td>'+value.created_at.slice(0,10)+' '+value.created_at.slice(11,19)+'</td>'+
                            '<td>'+worker+'</td>'+
                            '<td class="d-flex action-buttons">'+
                                '<a href="statistic/qayta/'+value.id+'" class=\'btn btn-primary w-100 mx-1\'>Qayta</a>'+
                                '<a href="statistic/deletePage/'+value.id+'" class=\'btn btn-danger w-100\'>O\'chirish</a>'+
                            '</td>'+
                        '</tr>'
                    );
                });
           }
        });
    });


                // Oy bo'yicha qidiruv
        $('#month').change(function () {
        $.ajax({
            type:'POST',
            url:"{{ route('statistic.filterByMonth') }}",
            data:{
                month:$('#month').val(),
                worker_id:$('#worker').val(),
            },
            success:function(response){
                console.log(response);
                $('#basketTbody').html('');
                $('#sumday').html('<small class="text-muted">Kunlik summa: </small>'+response.sumday+' so\'m');
                $('#summonth').html('<small class="text-muted">Oylik summa: </small>'+response.summonth+' so\'m');
                $.each(response.saleds, function(index, value){
                    let loop = index + 1;
                    let name = value.name === null ? "<span class='text-danger'>O'chirib yuborilgan</span>" : value.name;
                    let category = value.cat_name === null ? "<span class='text-danger'>O'chirib yuborilgan</span>" : value.cat_name;
                    let worker = value.fish === null ? "<span class='text-danger'>O'chirib yuborilgan</span>" : value.fish;
                    $('#basketTbody').append(
                        '<tr>'+
                            '<th scope="row">'+loop+'</th>'+
                            '<td>'+name+'</td>'+
                            '<td>'+value.product_count+'</td>'+
                            '<td>'+category+'</td>'+
                            '<td>'+value.product_price+'</td>'+
                            '<td>'+value.original_price+'</td>'+
                            '<td>'+value.summa+'</td>'+
                            '<td>'+value.created_at.slice(0,10)+' '+value.created_at.slice(11,19)+'</td>'+
                            '<td>'+worker+'</td>'+
                            '<td class="d-flex action-buttons">'+
                                '<a href="statistic/qayta/'+value.id+'" class=\'btn btn-primary w-100 mx-1\'>Qayta</a>'+
                                '<a href="statistic/deletePage/'+value.id+'" class=\'btn btn-danger w-100\'>O\'chirish</a>'+
                            '</td>'+
                        '</tr>'
                    );
                });
           }
        });
    });
</script>
@endsection --}}
@endsection