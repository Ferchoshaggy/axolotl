@extends('adminlte::page')

@section('title', 'Check List')

@section('content_header')
<div><h1><center>CHECK LIST</center></h1></div>
<!--este es para el selected2 -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" >

<!-- estos son para la tabla-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">

@stop
@section('content')

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true" style="font-weight: bold; color: black;" onclick="quitar_menu();">FUNCIONALES</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false"  style="font-weight: bold; color: black;" onclick="quitar_menu();">NO FUNCIONALES</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false"  style="font-weight: bold; color: black;">SEGURIDAD</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="contact-tab-2" data-toggle="tab" data-target="#contact-tab-pane-2" type="button" role="tab" aria-controls="contact-tab-pane-2" aria-selected="false"  style="font-weight: bold; color: black;">GENERAL</a>
  </li>
</ul>

<!-- menu desplegable-->
<div class="tab-content card" id="myTabContent" style="background-color: #FFFFFF;">

  <!--funcinales-->
  <div class="card-body tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

    <div class="table-responsive">
      <table class="table">
        <thead style="background:rgb(245, 187, 198); color:black;">
          <tr>
            <th scope="col" style="text-align: center;">Prueba</th>
            <th scope="col" style="text-align: center;">Caracteristica</th>
            <th scope="col" style="text-align: center;">Funciona</th>
            <th scope="col" style="text-align: center;">Observacion</th>
            <th scope="col" style="text-align: center;">Opciones</th>
          </tr>
        </thead>
        <tbody>
          
        </tbody>
      </table>
      
    </div>
  </div>

  <!--no funcinales-->
  <div class="card-body tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0" >
    
  </div>

  <!--seguridad-->
  <div class="card-body tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
      
  </div>
  <!--general-->
  <div class="card-body tab-pane fade" id="contact-tab-pane-2" role="tabpanel" aria-labelledby="contact-tab-2" tabindex="0">
      
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