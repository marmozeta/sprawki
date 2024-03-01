@extends('admin.layouts.app')

@section('content')
 <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Zarządzanie parametrem "czy gorący"</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted">Tablica</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Ustawienia</li>
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
                            <form method="post" action="{{ route('admin.settings.hot.update') }}">
                                @method('POST')
                                @csrf <!-- {{ csrf_field() }} -->
                                <div class="form-body row">
                                    @foreach($settings as $setting)
                                    <div class="form-group mb-3 col-4">
                                        <label class="form-label">{{ $setting->title }}*</label>
                                        <input type="number" class="form-control" name="{{ $setting->name }}" value="{{ old('value', $setting->value ?? '') }}" placeholder="" />
                                    </div>
                                  @endforeach
                                </div>
                                
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary">Zapisz</button>
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
