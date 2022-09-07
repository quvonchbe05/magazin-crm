@extends('layouts.app')
@section('title',"Xisobot")
@section('content__title',"Xisobot")
@section('content')
<div class="row justify-content-around">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-5 alert alert-info">
            <h1 class="p-5" id="sumday"><small class="text-muted">Kunlik summa: </small>{{ number_format($sumday) }}
                so'm</h1>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 mb-5 alert alert-danger">
            <h1 class="p-5" id="summonth"><small class="text-muted">Oylik summa: </small>{{ number_format($summonth) }}
                so'm</h1>
        </div>
    </div>
    @can('admin')                
    <div class="col-lg-6 text-center p-5 col-md-6 col-sm-12">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                <label class="text-muted" for="">Kun bo'yicha qidiruv:</label>
                <input type="date" class="form-control-lg form-control" id="date">
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                <label class="text-muted" for="">Oy bo'yicha qidiruv:</label>
                <input type="month" class="form-control form-control-lg" name="month" id="month">
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                <label class="text-muted" for="">Xodim bo'yicha qidiruv:</label>
                <select name="" class="form-control " id="worker">
                    <option value="">----</option>
                    @foreach ($workers as $worker)
                    <option value="{{ $worker->id }}">{{ $worker->fish }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 ">
                <a href="{{ route('statistic.more') }}" class="btn btn-primary">To'liq ro'yxatni ko'rish</a>
            </div>
        </div>
    </div>
    @endcan
    @can('direktor')                
    <div class="col-lg-6 text-center p-5 col-md-6 col-sm-12">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                <label class="text-muted" for="">Kun bo'yicha qidiruv:</label>
                <input type="date" class="form-control-lg form-control" id="date">
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                <label class="text-muted" for="">Oy bo'yicha qidiruv:</label>
                <input type="month" class="form-control form-control-lg" name="month" id="month">
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                <label class="text-muted" for="">Xodim bo'yicha qidiruv:</label>
                <select name="" class="form-control " id="worker">
                    <option value="">----</option>
                    @foreach ($workers as $worker)
                    <option value="{{ $worker->id }}">{{ $worker->fish }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 ">
                <a href="{{ route('statistic.more') }}" class="btn btn-primary">To'liq ro'yxatni ko'rish</a>
            </div>
        </div>
    </div>
    @endcan
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
            <th scope="col">Oxirgi sotilgan sana</th>
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
            <td>{{ $saled->updated_at }}</td>
            <td>
                @if (!isset($saled->worker->fish) || $saled->worker->fish == null)
                <span class="text-danger">O'chirilib yuborilgan</span>
                @else
                {{ $saled->worker->fish }}
                @endif
            </td>
            @can('admin')                
            <td class="d-flex justify-content-center">
                <a href="statistic/views?product={{ $saled->product_id }}&user={{ $saled->worker_id }}&date={{ date('Y-m-d') }}" class="btn btn-warning">To'liq ko'rish</a>
            </td>
            @endcan
            @can('direktor')                
            <td class="d-flex justify-content-center">
                <a href="statistic/views?product={{ $saled->product_id }}&user={{ $saled->worker_id }}&date={{ date('Y-m-d') }}" class="btn btn-warning">To'liq ko'rish</a>
            </td>
            @endcan
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $saleds->links() }}
</div>
@section('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // date bo'yicha qidiruv
    $('#date').change(function () {
        $('#month').val(''),
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
                            '<td>'+value.updated_at.slice(0,10)+' '+value.updated_at.slice(11,19)+'</td>'+
                            '<td>'+worker+'</td>'+
                            '<td class="d-flex justify-content-center action-buttons">'+
                                '<a href="statistic/views?product='+value.product_id+'&user='+value.worker_id+'&date='+value.updated_at.slice(0,10)+'" class=\'btn btn-warning\'>To\'liq ko\'rish</a>'+
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
                month:$('#month').val(),
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
                            '<td>'+value.updated_at.slice(0,10)+' '+value.updated_at.slice(11,19)+'</td>'+
                            '<td>'+worker+'</td>'+
                            '<td class="d-flex justify-content-center action-buttons">'+
                                '<a href="statistic/views?product='+value.product_id+'&user='+value.worker_id+'&date='+value.updated_at.slice(0,10)+'" class=\'btn btn-warning\'>To\'liq ko\'rish</a>'+
                            '</td>'+
                        '</tr>'
                    );
                });
           }
        });
    });


                // Oy bo'yicha qidiruv
        $('#month').change(function () {
            $('#date').val('');
        $.ajax({
            type:'POST',
            url:"{{ route('statistic.filterByDate') }}",
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
                            '<td>'+value.updated_at.slice(0,10)+' '+value.updated_at.slice(11,19)+'</td>'+
                            '<td>'+worker+'</td>'+
                            '<td class="d-flex justify-content-center action-buttons">'+
                                '<a href="statistic/views?product='+value.product_id+'&user='+value.worker_id+'&date='+value.updated_at.slice(0,10)+'" class=\'btn btn-warning\'>To\'liq ko\'rish</a>'+
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