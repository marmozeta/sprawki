@extends('admin.layouts.app')

@section('content')
 <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Dodawanie / edycja roli</h4>
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
                            @if (isset($role))

                            <form method="post" action="{{ route('admin.forms.role.update', $role->id) }}">

                                @method('POST')

                            @else
                                <form method="post" action="{{ route('admin.forms.role.store') }}">
                            @endif
                            
                                @csrf <!-- {{ csrf_field() }} -->
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12 form-group mb-3">
                                            <label class="form-label">Nazwa roli *</label>
                                            <input type="text" class="form-control" name="role_name" value="{{ old('role_name', $role->role_name ?? '') }}" placeholder="" />
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <label class="form-label pt-2">Uprawnienia do modułów *</label>
                                         <fieldset class="checkbox d-flex justify-content-between">
                                        <label>
                                            <input type="checkbox" class="attribute" name="menu" @if(in_array('menu', $permissions['modify']) || in_array('menu', $permissions['remove'])) checked @endif> &nbsp; &nbsp; &nbsp;Pozycje menu
                                        </label>
                                        <div class="d-flex required @if(!in_array('menu', $permissions['modify']) && !in_array('menu', $permissions['remove'])) d-none @endif" style="column-gap: 50px;">
                                            <div class="form-check form-switch required">
                                                <input class="form-check-input" type="checkbox" name="modify[menu]" role="switch" id="modify_menu" @if(in_array('menu', $permissions['modify'])) checked @endif>
                                                <label class="form-check-label" for="modify_menu">Edycja</label>
                                        </div>
                                            <div class="form-check form-switch required">
                                                <input class="form-check-input" type="checkbox" name="remove[menu]" role="switch" id="remove_menu" @if(in_array('menu', $permissions['remove'])) checked @endif>
                                                <label class="form-check-label" for="remove_menu">Usuwanie</label>
                                        </div>
                                            </div>
                                    </fieldset>
                                        <hr style="margin: 0.3rem 0;">
                                        @foreach($menus as $menu)
                                        <fieldset class="checkbox d-flex justify-content-between">
                                    <label>
                                        <input type="checkbox" class="attribute" name="{{ $menu->slug }}" @if(in_array($menu->slug, $permissions['modify']) || in_array($menu->slug, $permissions['remove'])) checked @endif> &nbsp; &nbsp; &nbsp;{{ $menu->name }}
                                    </label>
                                            <div class="d-flex required @if(!in_array($menu->slug, $permissions['modify']) && !in_array($menu->slug, $permissions['remove'])) d-none @endif" style="column-gap: 50px;">
                                            <div class="form-check form-switch required">
                                                <input class="form-check-input" type="checkbox" name="modify[{{ $menu->slug }}]" role="switch" id="modify_{{ $menu->slug }}" @if(in_array($menu->slug, $permissions['modify'])) checked @endif>
                                                <label class="form-check-label" for="modify_{{ $menu->slug }}">Edycja</label>
                                        </div>
                                            <div class="form-check form-switch required">
                                                <input class="form-check-input" type="checkbox" name="remove[{{ $menu->slug }}]" role="switch" id="remove_{{ $menu->slug }}" @if(in_array($menu->slug, $permissions['remove'])) checked @endif>
                                                <label class="form-check-label" for="remove_{{ $menu->slug }}">Usuwanie</label>
                                        </div>
                                            </div>
                                </fieldset>
                                        <hr style="margin: 0.3rem 0;">
                                        @endforeach
                                    <fieldset class="checkbox d-flex justify-content-between">
                                        <label>
                                            <input type="checkbox" class="attribute" name="tagi" @if(in_array('tagi', $permissions['modify']) || in_array('tagi', $permissions['remove'])) checked @endif> &nbsp; &nbsp; &nbsp;Tagi
                                        </label>
                                        <div class="d-flex required @if(!in_array('tagi', $permissions['modify']) && !in_array('tagi', $permissions['remove'])) d-none @endif" style="column-gap: 50px;">
                                            <div class="form-check form-switch required">
                                                <input class="form-check-input" type="checkbox" name="modify[tagi]" role="switch" id="modify_tagi" @if(in_array('tagi', $permissions['modify'])) checked @endif>
                                                <label class="form-check-label" for="modify_tagi">Edycja</label>
                                        </div>
                                            <div class="form-check form-switch required">
                                                <input class="form-check-input" type="checkbox" name="remove[tagi]" role="switch" id="remove_tagi" @if(in_array('tagi', $permissions['remove'])) checked @endif>
                                                <label class="form-check-label" for="remove_tagi">Usuwanie</label>
                                        </div>
                                            </div>
                                    </fieldset>
                                        <hr style="margin: 0.3rem 0;">
                                     <fieldset class="checkbox d-flex justify-content-between">
                                        <label>
                                            <input type="checkbox" class="attribute" name="kategorie" @if(in_array('kategorie', $permissions['modify']) || in_array('kategorie', $permissions['remove'])) checked @endif> &nbsp; &nbsp; &nbsp;Sklep - kategorie
                                        </label>
                                        <div class="d-flex required @if(!in_array('komentarze', $permissions['modify']) && !in_array('komentarze', $permissions['remove'])) d-none @endif" style="column-gap: 50px;">
                                            <div class="form-check form-switch required">
                                                <input class="form-check-input" type="checkbox" name="modify[kategorie]" role="switch" id="modify_kategorie" @if(in_array('kategorie', $permissions['modify'])) checked @endif>
                                                <label class="form-check-label" for="modify_kategorie">Edycja</label>
                                        </div>
                                            <div class="form-check form-switch required">
                                                <input class="form-check-input" type="checkbox" name="remove[kategorie]" role="switch" id="remove_kategorie" @if(in_array('kategorie', $permissions['remove'])) checked @endif>
                                                <label class="form-check-label" for="remove_kategorie">Usuwanie</label>
                                        </div>
                                            </div>
                                    </fieldset>
                                        <hr style="margin: 0.3rem 0;">
                                         <fieldset class="checkbox d-flex justify-content-between">
                                        <label>
                                            <input type="checkbox" class="attribute" name="uzytkownicy" @if(in_array('uzytkownicy', $permissions['modify']) || in_array('uzytkownicy', $permissions['remove'])) checked @endif> &nbsp; &nbsp; &nbsp;Lista użytkowników
                                        </label>
                                        <div class="d-flex required @if(!in_array('uzytkownicy', $permissions['modify']) && !in_array('uzytkownicy', $permissions['remove'])) d-none @endif" style="column-gap: 50px;">
                                            <div class="form-check form-switch required">
                                                <input class="form-check-input" type="checkbox" name="modify[uzytkownicy]" role="switch" id="modify_uzytkownicy" @if(in_array('uzytkownicy', $permissions['modify'])) checked @endif>
                                                <label class="form-check-label" for="modify_uzytkownicy">Edycja</label>
                                        </div>
                                            <div class="form-check form-switch required">
                                                <input class="form-check-input" type="checkbox" name="remove[uzytkownicy]" role="switch" id="remove_uzytkownicy" @if(in_array('uzytkownicy', $permissions['remove'])) checked @endif>
                                                <label class="form-check-label" for="remove_uzytkownicy">Usuwanie</label>
                                        </div>
                                            </div>
                                    </fieldset>
                                        <hr style="margin: 0.3rem 0;">
                                         <fieldset class="checkbox d-flex justify-content-between">
                                        <label>
                                            <input type="checkbox" class="attribute" name="role" @if(in_array('role', $permissions['modify']) || in_array('role', $permissions['remove'])) checked @endif> &nbsp; &nbsp; &nbsp;Role
                                        </label>
                                        <div class="d-flex required @if(!in_array('role', $permissions['modify']) && !in_array('role', $permissions['remove'])) d-none @endif" style="column-gap: 50px;">
                                            <div class="form-check form-switch required">
                                                <input class="form-check-input" type="checkbox" name="modify[role]" role="switch" id="modify_role" @if(in_array('role', $permissions['modify'])) checked @endif>
                                                <label class="form-check-label" for="modify_role">Edycja</label>
                                        </div>
                                            <div class="form-check form-switch required">
                                                <input class="form-check-input" type="checkbox" name="remove[role]" role="switch" id="remove_role" @if(in_array('role', $permissions['remove'])) checked @endif>
                                                <label class="form-check-label" for="remove_role">Usuwanie</label>
                                        </div>
                                            </div>
                                    </fieldset>
                                        <hr style="margin: 0.3rem 0;">
                                         <fieldset class="checkbox d-flex justify-content-between">
                                        <label>
                                            <input type="checkbox" class="attribute" name="komentarze" @if(in_array('komentarze', $permissions['modify']) || in_array('komentarze', $permissions['remove'])) checked @endif> &nbsp; &nbsp; &nbsp;Komentarze
                                        </label>
                                        <div class="d-flex required @if(!in_array('komentarze', $permissions['modify']) && !in_array('komentarze', $permissions['remove'])) d-none @endif" style="column-gap: 50px;">
                                           <!-- <div class="form-check form-switch required">
                                                <input class="form-check-input" type="checkbox" name="modify[komentarze]" role="switch" id="modify_komentarze" @if(in_array('komentarze', $permissions['modify'])) checked @endif>
                                                <label class="form-check-label" for="modify_komentarze">Edycja</label>
                                        </div>-->
                                            <div class="form-check form-switch required">
                                                <input class="form-check-input" type="checkbox" name="remove[komentarze]" role="switch" id="remove_komentarze" @if(in_array('komentarze', $permissions['remove'])) checked @endif>
                                                <label class="form-check-label" for="remove_komentarze">Usuwanie</label>
                                        </div>
                                            </div>
                                    </fieldset>
                                        <hr style="margin: 0.3rem 0;">
                                          <fieldset class="checkbox d-flex justify-content-between">
                                        <label>
                                            <input type="checkbox" class="attribute" name="sprzedaz" @if(in_array('sprzedaz', $permissions['modify']) || in_array('sprzedaz', $permissions['remove'])) checked @endif> &nbsp; &nbsp; &nbsp;Sprzedaż
                                        </label>
                                        <div class="d-flex required @if(!in_array('sprzedaz', $permissions['modify']) && !in_array('sprzedaz', $permissions['remove'])) d-none @endif" style="column-gap: 50px;">
                                            <div class="form-check form-switch required">
                                                <input class="form-check-input" type="checkbox" name="modify[sprzedaz]" role="switch" id="modify_sprzedaz" @if(in_array('sprzedaz', $permissions['modify'])) checked @endif>
                                                <label class="form-check-label" for="modify_sprzedaz">Edycja</label>
                                        </div>
                                            <div class="form-check form-switch required">
                                                <input class="form-check-input" type="checkbox" name="remove[sprzedaz]" role="switch" id="remove_sprzedaz" @if(in_array('sprzedaz', $permissions['remove'])) checked @endif>
                                                <label class="form-check-label" for="remove_sprzedaz">Usuwanie</label>
                                        </div>
                                            </div>
                                    </fieldset>
                                        <hr style="margin: 0.3rem 0;">
                                          <fieldset class="checkbox d-flex justify-content-between">
                                        <label>
                                            <input type="checkbox" class="attribute" name="ustawienia" @if(in_array('ustawienia', $permissions['modify'])) checked @endif> &nbsp; &nbsp; &nbsp;Ustawienia
                                        </label>
                                        <div class="d-flex required @if(!in_array('ustawienia', $permissions['modify'])) d-none @endif" style="column-gap: 50px;">
                                       <div class="form-check form-switch required">
                                                <input class="form-check-input" type="checkbox" name="modify[ustawienia]" role="switch" id="modify_ustawienia" @if(in_array('ustawienia', $permissions['modify'])) checked @endif>
                                                <label class="form-check-label" for="modify_ustawienia">Edycja</label>
                                        </div>
                                               <!--  <div class="form-check form-switch required">
                                                <input class="form-check-input" type="checkbox" name="remove[komentarze]" role="switch" id="remove_ustawienia">
                                                <label class="form-check-label" for="remove_ustawienia">Usuwanie</label>
                                        </div>-->
                                            </div>
                                    </fieldset>
                                        <hr style="margin: 0.3rem 0;">
                                    </div>
                                    <div class="row">
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
