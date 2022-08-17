@extends('layouts.app')
@section('title','Ishchilar')
@section('content__title',"Ishchilar ro'yxati:")
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
            <th scope="col">F.I.SH.</th>
            <th scope="col">Telefon 1</th>
            <th scope="col">Telefon 2</th>
            <th scope="col">Lavozimi</th>
            <th scope="col">
                <button class="btn btn-light w-100" data-bs-toggle="modal" data-bs-target="#addusermodal"><i
                        class="fas fa-plus mr-1"></i> Qo'shish</button>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($workers as $worker)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $worker->fish }}</td>
            <td>{{ $worker->phone1 }}</td>
            <td>{{ $worker->phone2 }}</td>
            <td>{{ $worker->role->role_name }}</td>
            <td class="d-flex">
                <button class="btn btn-primary w-100"><i class="far fa-edit"></i></button>
                <button class="btn btn-primary w-100"><i class="fas fa-eye"></i></button>
                <button class="btn btn-primary w-100"><i class="far fa-trash-alt"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!-- Add User Modal -->
<form action="{{ route('register.register') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="addusermodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Yangi ishchi qo'shish</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fish">F.I.SH.</label>
                        <input type="text" class="form-control" id="fish" name="fish"
                            placeholder="Ism Familiyani kiriting..." value="{{ old('fish') }}">
                    </div>
                    <div class="form-group">
                        <label for="phone1">Telefon 1</label>
                        <input type="number" class="form-control" id="phone1" name="phone1"
                            placeholder="Birinchi telefon raqamni kiriting..." value="{{ old('phone1') }}">
                    </div>
                    <div class="form-group">
                        <label for="phone2">Telefon 2(Ixtiyoriy)</label>
                        <input type="number" class="form-control" id="phone2" name="phone2"
                            placeholder="Ikkinchi telefon raqamni kiriting..."  value="{{ old('phone2') }}">
                    </div>
                    <div class="form-group">
                        <label for="t_sana">Tug'ilgan sana</label>
                        <input type="date" class="form-control" id="t_sana" name="t_sana"
                            placeholder="Ism Familiyani kiriting..." value="{{ old('t_sana') }}">
                    </div>
                    <div class="form-group">
                        <label for="role">Lavozimi</label>
                        <select class="form-control" id="role" name="role">
                            <option value="">----</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @selected(old('role' === $role->id))>
                                {{ $role->role_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="img">Surat</label>
                        <input type="file" class="form-control" id="img" name="img" accept="image/jpeg,image/png">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Tizimga kirishi uchun emailni kiriting..." value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Parol</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Tizimga kirishi uchun parolni kiriting..." value="{{ old('password') }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Qo'shimcha ma'lumot(Ixtiyoriy)</label>
                        <textarea name="description" class="form-control w-100" id="description" rows="4" placeholder="Ishchi xaqida qo'shimcha ma'lumot">{{ old('description') }}</textarea>
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
<!-- End Add User Modal -->
@endsection