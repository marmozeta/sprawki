@extends('admin.layouts.app')

@section('content')
<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Dodawanie / edycja tagu</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted">Tablica</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Słowniki</li>
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
                            @if (isset($tag))
                                <form method="post" action="{{ route('admin.forms.tag.update', $tag->tag_id) }}">
                                @method('POST')
                            @else
                                <form method="post" action="{{ route('admin.forms.tag.store') }}">
                            @endif
                            
                            @csrf <!-- {{ csrf_field() }} -->
                                <div class="form-body">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Nazwa tagu *</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name', $tag->name ?? '') }}" placeholder="" />
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">Grupa *</label>
                                        <select class="form-control" name="group_slug">
                                            <option value="tag" {{ (old('group_slug', $tag->group_slug ?? '')=='tag')?'selected':''}}>Tag</option>
                                            <option value="region" {{ (old('group_slug', $tag->group_slug ?? '')=='region')?'selected':''}}>Region geograficzny</option>
                                            <option value="space" {{ (old('group_slug', $tag->group_slug ?? '')=='space')?'selected':''}}>Przestrzeń</option>
                                        </select>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="active" role="switch" id="flexSwitchCheckDefault" {{ (old('active', $tag->active ?? '')==1)?'checked':''}}>
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Aktywna</label>
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
