@extends('admin.layouts.app')

@section('content')
 <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Dodawanie / edycja zamówienia</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Tablica</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Marketing</li>
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
                            @if (isset($order))

                            <form method="post" action="{{ route('admin.forms.order.update', $order->order_id) }}">

                                @method('POST')

                                @else
                                    <form method="post" action="{{ route('admin.forms.order.store') }}">
                                @endif
                            
                                @csrf <!-- {{ csrf_field() }} -->
                                <div class="form-body">
                                    <div class="row">
                                    <div class="form-group mb-3 col-6">
                                        <label class="form-label">Użytkownik *</label>
                                        <select class="form-control">
                                            @foreach($users as $user) 
                                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>                                
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3 col-3">
                                        <label class="form-label">Data zamówienia *</label>
                                        <input class="form-control" type="date" />
                                    </div>
                                    <div class="form-group mb-3 col-3">
                                        <label class="form-label">ID transakcji Tpay *</label>
                                        <input class="form-control" type="text" />
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Pozycje zamówienia *</label>
                                      
                                    </div>
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
