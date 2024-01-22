@extends('admin.layouts.app')

@section('content')
<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Dodawanie / edycja elementu {{ $menu->name }}</h4>
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
                            @if (isset($element))

                            <form method="post" action="{{ route('admin.forms.element.update', ['slug' => $menu->slug, 'id' => $element->element_id]) }}">

                                @method('POST')

                            @else
                            <form method="post" action="{{ route('admin.forms.element.store', $menu->slug) }}">
                            @endif
                            
                                @csrf <!-- {{ csrf_field() }} -->
                                <div class="form-body row">
                                    @foreach($attributes as $attr)
                                        @include('admin.forms.attributes.'.$attr->slug)   
                                    @endforeach
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
