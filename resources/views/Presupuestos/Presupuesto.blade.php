@extends('adminlte::page')

@section('title', 'Presupuesto')

@section('content_header')
<div><h1><center>PRESUPUESTO</center></h1></div>

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
                    <th scope="col">Costo de desarrollo</th>
                    <th scope="col">Total de egresos</th>
                    <th scope="col">G.Individual</th>
                    <th scope="col">G.Semanal</th>
                    <th scope="col">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                 

                </tbody>
              </table>
        </div>
<div style="display:flex; justify-content:flex-end; margin:2% 0 0 70%;">

    <button class="form-control btn btn-primary" style="margin:0 0 0 4%;">Calcular</button>
    <button class="form-control btn btn-info" style="margin:0 0 0 4%; background:orange; color:white">PDF</button>

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