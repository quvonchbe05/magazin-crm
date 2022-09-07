@extends('layouts.app')
@section('title','Xodimlar')
@section('content__title',"Xodimlar ro'yxati")
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
    <div class="col-lg-10 col-md-5 col-sm-12">
        <input type="text" class="form-control" placeholder="Ism Fmiliya bo'yicha qidiruv..." id="workerSearch">
    </div>
    <div class="col-lg-2  col-md-2 col-sm-12">
        <a href="{{ route('register.registerPage') }}" class="btn btn-dark w-100">Qo'shish</a>
    </div>
</div>
<table class="table table-bordered table-responsive-lg">
    <thead class="thead-dark">
        <tr>
            <th scope="col">№</th>
            <th scope="col">F.I.SH.</th>
            <th scope="col">Telefon 1</th>
            <th scope="col">Telefon 2</th>
            <th scope="col">Lavozimi</th>
            <th scope="col">
            </th>
        </tr>
    </thead>
    <tbody id="workersTbody">
        @foreach ($workers as $worker)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $worker->fish }}</td>
            <td>{{ $worker->phone1 }}</td>
            <td>
                @if($worker->phone2)
                {{ $worker->phone2 }}
                @else
                Mavjud emas
                @endif
            </td>
            <td>
                {{ $worker->role->role_name }}
            </td>
            <td class="d-flex">
                <a href="{{ route('register.updatePage',$worker->id) }}" class="btn btn-primary w-100">Taxrirlash</a>
                <a href="{{ route('register.show',$worker->id) }}" class="btn btn-warning w-100 mx-1">Ko'rish</a>
                <a href="{{ route('register.deletePage',$worker->id) }}" class="btn btn-danger w-100">O'chirish</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $workers->links() }}
</div>

@section('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // Fish bo'yicha qidiruv
    $('#workerSearch').keyup(function () {
        $.ajax({
            type:'POST',
            url:"{{ route('register.search') }}",
            data:{fish:$('#workerSearch').val()},
            success:function(response){
                $('#workersTbody').html('');
                $.each(response.workers, function(index, value){
                    let loop = index + 1;
                    let phone2 = value.phone2 === null ? "Mavjud emas" : value.phone2;
                    $('#workersTbody').append(
                        '<tr>'+
                            '<th scope="row">'+loop+'</th>'+
                            '<td>'+value.fish+'</td>'+
                            '<td>'+value.phone1+'</td>'+
                            '<td>'+phone2+'</td>'+
                            '<td>'+value.role_name+'</td>'+
                            '<td class="d-flex action-buttons">'+
                                '<a href="register/updatePage/'+value.id+'" class=\'btn btn-primary w-100\'>Taxrirlash</a>'+
                                '<a href="register/show/'+value.id+'" class=\'btn btn-warning w-100 mx-1\'>Ko\'rish</a>'+
                                '<a href="register/deletePage/'+value.id+'" class=\'btn btn-danger w-100\'>O\'chirish</a>'+
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