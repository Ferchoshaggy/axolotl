@extends('adminlte::page')

@section('title', 'Ux')

@section('content_header')
<div><h1><center>UX</center></h1></div>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
<link href="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

@stop
@section('content')

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
            <thead style="background:rgb(245, 187, 198); color:black;">
                  <tr>
                    <th scope="col">Clave</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Eliminar</th>
                    <th scope="col">Descargar</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td><button class="btn" style="background: rgb(160, 47, 160); color:white;">Eliminar</button></td>
                    <td><button class="btn" style="background: rgb(226, 94, 134); color:white;">Descargar</button></td>
                  </tr>
                </tbody>
              </table>
        </div>
<div style="display:flex; justify-content:flex-end; margin:2% 0 0 85%;">

    <button class="form-control btn btn-primary" data-toggle="modal" data-target="#ModalUX" style="margin:0 0 0 4%;">Nuevo</button>

</div>

    </div>
</div>

<!-- Modal Nuevo UX -->
<div class="modal fade bd-example-modal-lg" id="ModalUX" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Nuevo Documento de UX</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<div class="row">
  <div class="col-md-4">
<label for="Nombre">Nombre</label>
<input type="text" name="nombre" class="form-control">
  </div>
  <div class="col-md-4">
    <label for="clave">Clave</label>
    <input type="text" name="clave" class="form-control">
  </div>
  <div class="col-md-4">
    <label for="algo" style="visibility: hidden">-</label>
    <label class="btn btn-default btn-sm center-block btn-file form-control" style="background: rgb(226, 94, 134);">
      <i class="fa fa-upload fa-2x" aria-hidden="true"></i>
      <input type="file" name="archivo" style="display: none;">
    </label>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
  <label for="Descripcion">Descripcion</label>
  <textarea name="Descripcion" class="form-control"></textarea>
  </div>
</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background: rgb(160, 47, 160); color:white;">Cancelar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
      $(document).ready(function() {
    $('.table').DataTable({
       "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
       }
    });
  });
</script>

@stop