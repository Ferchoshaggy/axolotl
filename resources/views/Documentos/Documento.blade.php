@extends('adminlte::page')

@section('title', 'Documentos')

@section('content_header')
<div><h1><center>DOCUMENTOS</center></h1></div>
<!--este es para el selected2 -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" >

<!-- estos son para la tabla-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">



@stop
@section('content')

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
            <thead style="background:rgb(245, 187, 198); color:black;">
                  <tr>
                    <th scope="col" style="text-align: center;">Fecha</th>
                    <th scope="col" style="text-align: center;">Nombre</th>
                    <th scope="col" style="text-align: center;">Descripcion</th>
                    <th scope="col" style="text-align: center;">Eliminar</th>
                    <th scope="col" style="text-align: center;">Descargar</th>
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

    <button class="form-control btn btn-primary" data-toggle="modal" data-target="#ModalDocumento" style="margin:0 0 0 5%;">Nuevo</button>

</div>

    </div>
</div>
<!-- Modal Nuevo Documento -->
<div class="modal fade bd-example-modal-lg" id="ModalDocumento" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Nuevo Documento</h5>
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
    <label for="Fecha">Fecha de Recibido</label>
    <input type="date" name="fecha" class="form-control">
  </div>
  <div class="col-md-4">
    <label for="documento">Documento</label>
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
    
@stop

@section('js')
<!-- estos son para la tabla-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<!-- este es para el selected2-->
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