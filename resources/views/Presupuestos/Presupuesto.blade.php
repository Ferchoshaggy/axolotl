@extends('adminlte::page')

@section('title', 'Presupuesto')

@section('content_header')
<div><h1><center>PRESUPUESTO</center></h1></div>
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
                    <th scope="col" style="text-align: center;">Costo de desarrollo</th>
                    <th scope="col" style="text-align: center;">Total de egresos</th>
                    <th scope="col" style="text-align: center;">G.Individual</th>
                    <th scope="col" style="text-align: center;">G.Semanal</th>
                    <th scope="col" style="text-align: center;">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                 

                </tbody>
              </table>
        </div>
<div style="display:flex; justify-content:flex-end; margin:2% 0 0 70%;">

    <button class="form-control btn btn-primary" data-toggle="modal" data-target="#ModalPresupuesto" style="margin:0 0 0 4%;">Calcular</button>
    <button class="form-control btn btn-info" style="margin:0 0 0 4%; background:orange; color:white">PDF</button>

</div>

    </div>
</div>

<!-- Modal Nuevo Presupuesto-->
<div class="modal fade bd-example-modal-lg" id="ModalPresupuesto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Presupuesto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<div class="row">
  <div class="col-md-3">
<label for="costo">Costo Por Sprint</label>
<input type="number" name="costo" class="form-control">
  </div>
  <div class="col-md-3">
    <label for="integrantes">Numero de Integrantes</label>
    <input type="number" name="integrantes" class="form-control">
  </div>
  <div class="col-md-3">
    <label for="semanas">Semanas de trabajo</label>
    <input type="number" name="semanas" class="form-control">
  </div>
  <div class="col-md-3">
    <label for="sprints">Numero de sprint's</label>
    <input type="number" name="sprints" class="form-control">
  </div>
</div>

<div class="row">
  <div class="col-md-3">
  <label for="Egreso">Egreso</label>
  <input type="number" name="egreso" class="form-control">
  </div>
  <div class="col-md-6">
    <label for="concepto">Concepto del Egreso</label>
    <textarea name="concepto" class="form-control"></textarea>
  </div>
  <div class="col-md-3">
    <label style="visibility: hidden">--</label>
    <button type="button" class="btn btn-success form-control">Agregar</button>
  </div>
</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background: rgb(160, 47, 160); color:white;">Cancelar</button>
        <button type="button" class="btn btn-primary">Actualizar</button>
      </div>
    </div>
  </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
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