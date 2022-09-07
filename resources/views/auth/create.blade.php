@extends('layouts.app')
@section('title','Xodim qo\'shish')
@section('content__title',"Xodim qo'shish:")
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
<form action="{{ route('register.register') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 my-4">
            <label for="fish">F.I.SH.</label>
            <input type="text" class="form-control" value="{{ old('fish') }}" id="fish" name="fish" required>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 my-4">
            <label for="role">Lavozimi</label>
            <select class="form-control" id="role" name="role" required>
                <option value="">----</option>
                @foreach ($roles as $role)
                <option value="{{ $role->id }}" @selected($role->id == old('role'))>
                    {{ $role->role_name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 my-4">
            <label for="phone1">Telefon 1</label>
            <input type="number" class="form-control" value="{{ old('phone1') }}" id="phone1" name="phone1" required>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 my-4">
            <label for="phone2">Telefon 2 (Ixtiyoriy)</label>
            <input type="number" class="form-control" value="{{ old('phone2') }}" id="phone2" name="phone2">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 my-4">
            <label for="t_sana">Tug'ilgan sana</label>
            <input type="date" class="form-control" value="{{ old('t_sana') }}" id="t_sana"
                name="t_sana" required>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 my-4">
            <label for="img">Rasm</label>
            <input type="file" class="form-control" value="{{ old('img') }}" id="img" name="img">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 my-4">
            <label for="email">Email</label>
            <input type="email" class="form-control" value="{{ old('email') }}" id="email"
                name="email" placeholder="Tizimga kirishi uchun email..." required>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 my-4">
            <label for="password">Parol</label>
            <input type="password" class="form-control" placeholder="Tizimga kirishi uchun parol..." value="{{ old('password') }}" id="password" name="password" required>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 my-4  ">
            <label for="description">Xodim xaqida qo'shimcha ma'lumot (Ixtiyoriy)</label>
            <textarea name="description" class="form-control" id="description" rows="4"
                placeholder="Xodim xaqida qo'shimcha ma'lumot">{{ old('description') }}</textarea>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 my-4">
            <label for="kelgan_sana">Kelgan sana</label>
            <input type="date" class="form-control" placeholder="Tizimga kirishi uchun parol..." value="{{ old('kelgan_sana') }}" id="kelgan_sana" name="kelgan_sana" required>
            <div class="d-flex justify-content-end pt-4">
                <a href="{{ route('register.index') }}" class="btn btn-primary my-4 mx-1">Orqaga</a>
                <button type="submit" class="btn btn-primary my-4">Qo'shish</button>
            </div>
        </div>
    </div>
</form>
@endsection