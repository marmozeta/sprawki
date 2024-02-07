@extends('admin.layouts.app')

@section('content')
 <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Dodawanie / edycja pozycji menu</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted">Tablica</a></li>
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
                                    <div class="form-group mb-3">
                                        <label class="form-label">Ikona *</label>
                                        <input type="text" class="form-control" name="icon" value="{{ old('icon', $menu->icon ?? '') }}" placeholder="" />
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">Wyświetlaj w menu *</label>
                                        <select class="form-control" name="in_menu">
                                            <option value="1" {{ (old('in_menu', $menu->in_menu ?? '')==1)?'selected':'' }}>tak</option>
                                            <option value="0" {{ (old('in_menu', $menu->in_menu ?? '')==0)?'selected':'' }}>nie</option>
                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div class="form-group mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="is_shop" role="switch" id="is_shop" {{ (old('is_shop', $menu->is_shop ?? '')==1)?'checked':''}} >
                                                <label class="form-check-label" for="is_shop">Ustaw jako sklep</label>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="is_social" role="switch" id="is_social" {{ (old('is_social', $menu->is_social ?? '')==1)?'checked':''}} >
                                                <label class="form-check-label" for="is_social">Ustaw jako społeczność</label>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="linked_elements" role="switch" id="linked_elements" {{ (old('linked_elements', $menu->linked_elements ?? '')==1)?'checked':''}} >
                                                <label class="form-check-label" for="linked_elements">Elementy jako linki</label>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="has_likes" role="switch" id="has_likes" {{ (old('has_likes', $menu->has_likes ?? '')==1)?'checked':''}} >
                                                <label class="form-check-label" for="has_likes">Polubienia</label>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="has_comments" role="switch" id="has_comments" {{ (old('has_comments', $menu->has_comments ?? '')==1)?'checked':''}} >
                                                <label class="form-check-label" for="has_comments">Komentarze</label>
                                            </div>
                                        </div>
                                    <div class="col-2">
                                        <div class="form-group mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="has_arguments" role="switch" id="has_arguments" {{ (old('has_arguments', $menu->has_arguments ?? '')==1)?'checked':''}} >
                                                <label class="form-check-label" for="has_arguments">Argumenty</label>
                                            </div>
                                        </div>
                                    </div>
                                        </div>
                                    <div>
                                        
                                <label class="form-label pt-2">Atrybuty *</label>
                                @foreach($attributes as $attr)
                                <fieldset class="checkbox d-flex justify-content-between">
                                    <label>
                                        <input type="checkbox" class="attribute" name="attrs[{{$attr->attr_id}}]" @if(array_key_exists($attr->attr_id, $checked)) checked @endif> &nbsp; &nbsp; &nbsp;{{ $attr->name }}
                                    </label>
                                    @if($attr->slug != 'is_new' && $attr->slug != 'is_hot' && $attr->slug != 'is_sale' && $attr->slug != 'is_virtual')  
                                        <div class="form-check form-switch required @if(!array_key_exists($attr->attr_id, $checked)) d-none @endif mb-0">
                                            <input class="form-check-input" type="checkbox" name="required[{{$attr->attr_id}}]" role="switch" id="flexSwitchCheckDefault{{ $attr->attr_id }}" @if(isset($checked[$attr->attr_id]) && $checked[$attr->attr_id]) checked @endif>
                                                   <label class="form-check-label" for="flexSwitchCheckDefault{{ $attr->attr_id }}">Wymagany</label>
                                        </div>
                                    @endif
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
