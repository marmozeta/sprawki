@extends('admin.layouts.app')

@section('content')<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">{{ $menu->name }}</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted">Tablica</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Elementy</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-5 align-self-center">
                        <div class="customize-input float-end">
                            @if(in_array($menu->slug, $user_permissions['modify']))
                                <a class="btn waves-effect waves-light btn-rounded btn-primary" href="{{ route('admin.forms.element', $menu->slug) }}">Nowy element</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- basic table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    @if(count($elements)>0)
                                    <table id="zero_config" class="table border table-striped table-bordered text-nowrap" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tytuł</th>
                                                <th>Obrazek</th>
                                                <th>Autor</th>
                                                @if(is_array($menu->attrs_list) && in_array('is_active', $menu->attrs_list))
                                                    <th>Aktywny</th>
                                                @endif
                                                @if(is_array($menu->attrs_list) && in_array('ad_weight', $menu->attrs_list))
                                                    <th>Waga reklamy</th>
                                                @endif
                                                <th>Data dodania</th>
                                                <th>Data modyfikacji</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($elements as $element)
                                                <tr>
                                                    <td>{{ $element->element_id }}</td>
                                                    <td style="white-space: break-spaces;">{{ $element->title }}</td>
                                                    <td>
                                                        @if(!empty($element->image))
                                                            <img src="{{ asset('images/elements') }}/{{ $element->image }}" width="150" class="img-thumbnail" />
                                                        @endif
                                                    </td>
                                                    <td>@if(!empty($element->friendly_name)) {{ '@'.$element->friendly_name }}@endif</td>                                                  
                                                    @if(is_array($menu->attrs_list) && in_array('is_active', $menu->attrs_list))
                                                        <td class="text-center">
                                                            @if($element->is_active == 1)
                                                                <i class="fa fa-circle text-success font-12"
                                                            data-bs-toggle="tooltip" data-placement="top"
                                                            title="Aktywna"></i>
                                                            @else
                                                                <i class="fa fa-circle text-danger font-12"
                                                            data-bs-toggle="tooltip" data-placement="top"
                                                            title="Nieaktywna"></i>
                                                            @endif
                                                        </td>
                                                    @endif
                                                    @if(is_array($menu->attrs_list) && in_array('ad_weight', $menu->attrs_list))
                                                        <td>{{ $element->ad_weight }}</td>
                                                    @endif
                                                    <td>{{ Carbon\Carbon::parse($element->created_at) }}</td>
                                                    <td>{{ Carbon\Carbon::parse($element->updated_at) }}</td>
                                                    <td class="text-center">
                                                        @if(in_array($menu->slug, $user_permissions['modify']))
                                                            <a href="{{ route('admin.forms.element.edit', ['slug' => $menu->slug, 'id' => $element->element_id]) }}"><i class="fa fa-edit"></i></a>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if(in_array($menu->slug, $user_permissions['remove']))
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="{{ route('admin.forms.element.remove', ['slug' => $menu->slug, 'id' => $element->element_id]) }}"><i class="fa fa-trash"></i></a>
                                                            @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tytuł</th>
                                                <th>Obrazek</th>
                                                <th>Autor</th>
                                                @if(is_array($menu->attrs_list) && in_array('is_active', $menu->attrs_list))
                                                    <th>Aktywny</th>
                                                @endif
                                                @if(is_array($menu->attrs_list) && in_array('ad_weight', $menu->attrs_list))
                                                    <th>Waga reklamy</th>
                                                @endif
                                                <th>Data dodania</th>
                                                <th>Data modyfikacji</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    @else
                                        Do tej pozycji menu nie dodano jeszcze żadnych elementów
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content modal-filled bg-warning">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">UWAGA</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          Czy na pewno chcesz usunąć ten element?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
        <a class="btn btn-primary">Tak, usuń</a>
      </div>
    </div>
  </div>
</div>
<script>
    var exampleModal = document.getElementById('exampleModal')
exampleModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  var modalFooterLink = exampleModal.querySelector('.modal-footer a')

  modalFooterLink.href = recipient;
})
    </script>
@endsection