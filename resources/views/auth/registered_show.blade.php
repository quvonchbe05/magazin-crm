@extends('layouts.app')
@section('title',"To'liq")
@section('content__title')
{{ $worker->fish }} xaqida to'liq ma'lumot:
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
<div class="row">
    <div class="col-lg-4 col-ma-6 col-sm-12 ">
        <img src="{{ asset($worker->img_path) }}" class="img-fluid rounded" alt="IMG">
    </div>
    <div class="col-lg-8 col-ma-6 col-sm-12">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 my-4">
                <i>F.I.SH.:</i>
                <h4>{{ $worker->fish }}</h4>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 my-4">
                <i>Lavozimi:</i>
                <h4>{{ $worker->role->role_name }}</h4>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 my-4">
                <i>Telefon 1:</i>
                <h4>{{ $worker->phone1 }}</h4>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 my-4">
                <i>Telefon 2:</i>
                <h4>
                    @if($worker->phone2)
                    {{ $worker->phone2 }}
                    @else
                    Mavjud emas
                    @endif
                </h4>
            </div>
        </div>
    </div>
</div>
<div class="row mx-3">
    <div class="col-lg-4 col-md-6 col-sm-12 my-4">
        <i>Tug'ilgan sana:</i>
        <h4>{{ $worker->t_sana }}</h4>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 my-4">
        <i>Ishga kelgan sana:</i>
        <h4>{{ $worker->kelgan_sana }}</h4>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 my-4">
        <i>Email:</i>
        <h4>{{ $worker->email }}</h4>
    </div>
    <div class="col-lg-10 col-md-12 col-sm-12">
        <i>Ishchi xaqida qisqacha:</i>
        <h4>{{ $worker->description }}</h4>
    </div>
    <div class="col-lg-2 col-md-12 col-sm-12 d-flex justify-content-center align-items-center">
        <button class="btn btn-primary w-100"  data-bs-toggle="modal" data-bs-target="#deleteusermodal{{ $worker->id }}"><i class="far fa-trash-alt"></i></button>
                <!-- Delete User Modal -->
                    <div class="modal fade" id="deleteusermodal{{ $worker->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel">Xodimni o'chirish</h4>
                                </div>
                                <div class="modal-body">
                                    <h3 class="text-danger">Siz rostdanxam {{ $worker->fish }}ni o'chirib tashlamoqchimisiz!</h3>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Orqaga</button>
                                    <a href="{{ route('register.delete',$worker->id) }}" class="btn btn-primary">O'chirish</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- End Delete User Modal -->
        <button class="btn btn-primary w-100" data-bs-toggle="modal"
        data-bs-target="#updateusermodal{{ $worker->id }}"><i class="far fa-edit"></i></button>
        <a href="{{ route('register.index') }}" class="btn btn-primary w-100">Orqaga</a> 
        <!-- Update User Modal -->
        <form action="{{ route('register.update',$worker->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal fade" id="updateusermodal{{ $worker->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Xodimni taxrirlash</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="fish">F.I.SH.</label>
                                <input type="text" class="form-control" id="fish" name="fish"
                                    placeholder="Ism Familiyani kiriting..." value="{{ $worker->fish }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone1">Telefon 1</label>
                                <input type="number" class="form-control" id="phone1" name="phone1"
                                    placeholder="Birinchi telefon raqamni kiriting..." value="{{ $worker->phone1 }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="phone2">Telefon 2(Ixtiyoriy)</label>
                                <input type="number" class="form-control" id="phone2" name="phone2"
                                    placeholder="Ikkinchi telefon raqamni kiriting..." value="{{ $worker->phone2 }}">
                            </div>
                            <div class="form-group">
                                <label for="t_sana">Tug'ilgan sana</label>
                                <input type="date" class="form-control" id="t_sana" name="t_sana"
                                    placeholder="Ism Familiyani kiriting..." value="{{ $worker->t_sana }}" required>
                            </div>
                            <div class="form-group">
                                <label for="role">Lavozimi</label>
                                <select class="form-control" id="role" name="role""
                                    required>
                                    <option value="">----</option>
                                    @foreach ($roles as $role)
                                    <option value=" {{ $role->id }}" @selected($role->id == $worker->role->id)>
                                    {{ $role->role_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="img">Surat</label>
                                <input type="file" class="form-control" id="img" name="img"
                                    accept="image/jpeg,image/png">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Tizimga kirishi uchun emailni kiriting..." value="{{ $worker->email }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="password">Parol</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Tizimga kirishi uchun parolni kiriting..."
                                    value="{{ old('password') }}">
                            </div>
                            <div class="form-group">
                                <label for="kelgan_sana">Ishga kelgan sana</label>
                                <input type="date" class="form-control" id="kelgan_sana" name="kelgan_sana"
                                    value="{{ $worker->kelgan_sana }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Qo'shimcha ma'lumot(Ixtiyoriy)</label>
                                <textarea name="description" class="form-control w-100" id="description" rows="4"
                                    placeholder="Xodim xaqida qo'shimcha ma'lumot">{{ $worker->description }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Orqaga</button>
                            <button type="submit" class="btn btn-primary">Taxrirlash</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Update User Modal -->
    </div>
</div>
@endsection