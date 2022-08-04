@extends('adminlte::page')

@section('title', 'Matriz Master')

@section('content_header')
<div><h1><center>MATRIZ MASTER</center></h1></div>
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
                    <th scope="col" style="text-align: center;">Clave</th>
                    <th scope="col" style="text-align: center;">Sprint</th>
                    <th scope="col" style="text-align: center;">Descripcion</th>
                    <th scope="col" style="text-align: center;">Avance</th>
                    <th scope="col" style="text-align: center;">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td><button type="button" class="btn" data-toggle="modal" data-target="#ModalPorcentaje" style="background: rgb(160, 47, 160); color:white;">Asignar</button></td>
                  </tr>
                </tbody>
              </table>
        </div>
<div style="display:flex; justify-content:flex-end; margin:2% 0 0 70%;">

    <button class="form-control btn" style="margin:0 4% 0 0; background: rgb(160, 47, 160); color:white;">Editar</button>
    <button class="form-control btn" style="margin:0 0 0 4%; background:orange; color:white">PDF</button>

</div>

    </div>
</div>

<!--Modal de Asginacion porcentaje -->

<div class="modal fade" id="ModalPorcentaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Asignar Porcentaje</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control" name="porcentaje">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal" style="background: rgb(160, 47, 160); color:white">Cancelar</button>
        <button type="button" class="btn" style="background: rgb(245, 187, 198); color:white">Aceptar</button>
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