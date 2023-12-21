@extends('admin.layouts.app')

@section('content')
 <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Dodawanie / edycja pozycji menu</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Tablica</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Elementy</li>
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
                            @if (isset($menu))

                            <form method="post" action="{{ route('admin.forms.menu.update', $menu->menu_id) }}">

    @method('POST')

@else
    <form method="post" action="{{ route('admin.forms.menu.store') }}">
@endif
                            
                                @csrf <!-- {{ csrf_field() }} -->
                                <div class="form-body">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Nazwa pozycji menu *</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name', $menu->name ?? '') }}" placeholder="" />
                                        <input type="hidden" name="ordinal_number" value="1" />
                                    </div>
                                    <div>
                                        
                                <label class="form-label pt-2">Atrybuty *</label>
                                @foreach($attributes as $attr)
                                <fieldset class="checkbox d-flex justify-content-between">
                                    <label>
                                        <input type="checkbox" class="attribute" name="attrs[{{$attr->attr_id}}]" @if(array_key_exists($attr->attr_id, $checked)) checked @endif> &nbsp; &nbsp; &nbsp;{{ $attr->name }}
                                    </label>
                                    <div class="form-check form-switch required @if(!array_key_exists($attr->attr_id, $checked)) d-none @endif mb-0">
                                        <input class="form-check-input" type="checkbox" name="required[{{$attr->attr_id}}]" role="switch" id="flexSwitchCheckDefault" @if(isset($checked[$attr->attr_id]) && $checked[$attr->attr_id]) checked @endif>
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Wymagany</label>
                                    </div>
                                </fieldset>
                                <hr style="margin: 0.3rem 0;"/>
                                @endforeach
                            
                                    </div>
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
