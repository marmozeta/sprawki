@extends('admin.layouts.app')

@section('content')
<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Dodawanie / edycja kategorii</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Tablica</a></li>
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
                            @if (isset($category))
                                <form method="post" action="{{ route('admin.forms.category.update', $category->cat_id) }}">
                                @method('POST')
                            @else
                                <form method="post" action="{{ route('admin.forms.category.store') }}">
                            @endif
                            
                            @csrf <!-- {{ csrf_field() }} -->
                                <div class="form-body">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Nazwa kategorii *</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name', $category->name ?? '') }}" placeholder="" />
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="active" role="switch" id="flexSwitchCheckDefault">
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
