@extends('admin.layouts.app')

@section('content')<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Wyszukiwarka</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted">Tablica</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Dashboard</li>
                                </ol>
                            </nav>
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
                                    <table id="zero_config" class="table border table-striped table-bordered text-nowrap" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Typ rekordu</th>
                                                <th>Tytuł / nazwa</th>
                                                <th>Data dodania</th>
                                                <th>Data modyfikacji</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($result as $res)
                                                <tr>
                                                    <td>{{ $res->id }}</td>
                                                    <td>{{ $res->type_name }}</td>
                                                    <td>{{ $res->name }}</td>
                                                    <td>{{ Carbon\Carbon::parse($res->created_at) }}</td>
                                                    <td>{{ Carbon\Carbon::parse($res->updated_at) }}</td>
                                                    <td class="text-center">
                                                        @if($res->modify == 1)
                                                            @if(!empty($res->slug))
                                                                <a href="{{ route('admin.forms.'.$res->type.'.edit', ['id' => $res->id, 'slug' => $res->slug]) }}"><i class="fa fa-edit"></i></a>
                                                            @else
                                                                <a href="{{ route('admin.forms.'.$res->type.'.edit', ['id' => $res->id]) }}"><i class="fa fa-edit"></i></a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if($res->remove == 1)
                                                            @if(!empty($res->slug))
                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="{{ route('admin.forms.'.$res->type.'.remove', ['id' => $res->id, 'slug' => $res->slug]) }}"><i class="fa fa-trash"></i></a>                                                       
                                                            @else
                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="{{ route('admin.forms.'.$res->type.'.remove', ['id' => $res->id]) }}"><i class="fa fa-trash"></i></a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Typ rekordu</th>
                                                <th>Tytuł / nazwa</th>
                                                <th>Data dodania</th>
                                                <th>Data modyfikacji</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
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
          Czy na pewno chcesz usunąć tą rolę?
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