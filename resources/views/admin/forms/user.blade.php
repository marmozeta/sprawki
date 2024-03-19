@extends('admin.layouts.app')

@section('content')
 <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Dodawanie / edycja użytkownika</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted">Tablica</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Użytkownicy</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if (isset($user))

                            <form method="post" action="{{ route('admin.forms.user.update', $user->id) }}">

                                @method('POST')

                            @else
                                <form method="post" action="{{ route('admin.forms.user.store') }}">
                            @endif
                            
                                @csrf <!-- {{ csrf_field() }} -->
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6 form-group mb-3">
                                            <label class="form-label">Imię i nazwisko *</label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name', $user->name ?? '') }}" placeholder="" />
                                        </div>
                                        <div class="col-6 form-group mb-3">
                                            <label class="form-label">Adres e-mail *</label>
                                            <input type="text" class="form-control" name="email" value="{{ old('email', $user->email ?? '') }}" placeholder="" />
                                        </div>
                                        <div class="col-6 form-group mb-3">
                                            <label class="form-label">Rola *</label>
                                            <select class="form-control" name="role">
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}" @if($user->role_id == $role->id) checked @endif>{{ $role->role_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                    
                                        <div class="col-6 form-group mb-3">
                                            <label class="form-label">Hasło</label>
                                                <div class="input-group mb-3">
                                            <input type="password" class="form-control" name="password" aria-describedby="basic-addon2">
                                            <span class="input-group-text" id="basic-addon2"><a href="#" onClick="showHidePassword();"><i class="fa-solid fa-eye-slash"></i></a></span>
                                            <span class="input-group-text" id="basic-addon2"><a href="#" onClick="generatePassword()"><i class="fa-solid fa-dice"></i></a></span>
                                          </div>
                                        </div>
                                        <div class="col-6 form-group mb-3">
                                            <label class="form-label">Powtórz hasło</label>
                                            <input type="password" class="form-control" name="confirm_password" placeholder="" />
                                        </div>
                                           @if (!isset($user))
                                    <div class="col-6 form-group mb-3">
                                        <input type="checkbox" name="send_data" checked placeholder="" />
                                        <label class="form-label">Wyślij do użytkownika wiadomość e-mail z danymi</label>
                                    </div>
                                           @endif
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary">Zapisz</button>
                                    </div>
                                </div>
                            </form>
                        </div> 
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
