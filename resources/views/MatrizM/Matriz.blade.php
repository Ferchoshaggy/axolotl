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
<style type="text/css">

  li{
    transition: .6s;
  }
  li:hover{
    font-size: 18px;
    transition: .6s;
  }

  .boton_rosa{
        margin:0 3% 0 0; 
        background:rgb(235, 75, 235); 
        color:white;
        font-weight: bold;
    }
    .boton_rosa:hover{
        background-color:rgb(165, 48, 165); 
        color:white;
    }

  .marca{
    transition: 1s;
  }
  .marca:hover{
    background: #DBDBDB;
    transition: 1s;
  }

  .boton_morado{
    background: rgb(160, 90, 220); 
    color:white;
  }

  .boton_morado:hover{
    background: rgb(122, 62, 174); 
    color:white;
  }
/*
  tr[title]:hover {
    position: relative;
  }
   
  tr[title]:hover:after {
    font-size: 15px;
    position: absolute;
    left: 13%;
    top: 50%;
    padding: 2px;
    background: grey;
    white-space: nowrap;
    z-index: 99;
    transform: translateX(-50%);
    content: attr(title);
  }
  */
</style>

@if(Session::has('message'))
<br>
<div class="alert alert-{{ Session::get('color') }}" role="alert" style="font-weight: bold;">
   {{ Session::get('message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif


<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
            <thead style="background:rgb(245, 187, 198); color:black;">
                  <tr>
                    <th style="text-align: center;">Clave</th>
                    <th style="text-align: center;">Sprint</th>
                    <th style="text-align: center;">Descripcion</th>
                    <th style="text-align: center;">Avance</th>
                    <th style="text-align: center;">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $contador_modulos=1; ?>
                  @foreach($modulos as $modulo)
                  <?php $contador_sprints=1; ?>
                  @foreach($sprints as $sprint)
                  @if($sprint->id_modulo==$modulo->id)
                  <tr title="MODULO: {{$modulo->nombre}}" class="marca">
                    <td style="text-align: center;">{{$contador_modulos}}.{{$contador_sprints}}</td>
                    <td style="text-align: center;">{{$sprint->nombre}}</td>
                    <td style="text-align: center;">{{$sprint->descripcion}}</td>
                    <td style="text-align: center;">{{$sprint->porcentaje}}%</td>
                    <td style="text-align: center;">

                      <button type="button" class="btn boton_morado" data-toggle="modal" data-target="#ModalPorcentaje" onclick="pasar_id_registro({{$sprint->id}},{{$modulo->id}});">Asignar</button>

                    </td>
                  </tr>
                  <?php $contador_sprints++;?>
                  @endif
                  @endforeach
                  <?php $contador_modulos++;?>
                  @endforeach
                  
                </tbody>
              </table>
        </div>
<div style="display:flex; justify-content:flex-end; margin:2% 0 0 70%;">

    <button class="form-control btn boton_morado">Editar</button>
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
      <form method="POST" action="{{url('/Cambio_Porcentaje')}}">
        @csrf
        <div class="modal-body">
          <div style="text-align: center;">
            <label style="font-size: 20px; text-align: center; font-weight: bold;">NOMBRE MODULO:</label>
            <label style="font-size: 20px; text-align: center; font-weight: bold; color: red;" id="text_nombre_modulo">Miguelillo</label>
          </div>
          <div style="text-align: center;">
            <label style="font-size: 20px; text-align: center; font-weight: bold;">NOMBRE SPRINT:</label>
            <label style="font-size: 20px; text-align: center; font-weight: bold; color: red;" id="text_nombre">Miguelillo</label>
          </div>

          <div class="input-group mb-3">
            <input type="number" class="form-control" name="porcentaje" min="0" max="100" step="any" aria-label="Amount (to the nearest dollar)" required>
            <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-percent" viewBox="0 0 16 16"><path d="M13.442 2.558a.625.625 0 0 1 0 .884l-10 10a.625.625 0 1 1-.884-.884l10-10a.625.625 0 0 1 .884 0zM4.5 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm7 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/></svg></span>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id_sprint" id="id_sprint">
          <button type="button" class="btn boton_morado" data-dismiss="modal" >Cancelar</button>
          <button class="btn boton_rosa" >Actualizar</button>
        </div>

      </form>
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

    function pasar_id_registro($id, $id_modulo) {
      document.getElementById("id_sprint").value=$id;
      document.getElementById("text_nombre_modulo").innerHTML=null;
      document.getElementById("text_nombre").innerHTML=null;
      $.ajax({
        url: "{{url('/Search_Sprint')}}"+'/'+$id,
        dataType: "json",
        //context: document.body
      }).done(function(s_sprint) {
        //$( this ).addClass( "done" );
        //console.log(s_sprint);

        //s_sprint.length==null
        if(s_sprint==null){

          document.getElementById("id_sprint").value=null;
          //document.getElementById("text_nombre_modulo").innerHTML=null;
          document.getElementById("text_nombre").innerHTML=null;

        }else{

          $.ajax({
            url: "{{url('/Search_Modulo')}}"+'/'+$id_modulo,
            dataType: "json",
            //context: document.body
          }).done(function(s_modulo) {

            if(s_modulo==null){
              document.getElementById("text_nombre_modulo").innerHTML=null;
            }else{
              document.getElementById("text_nombre_modulo").innerHTML=s_modulo.nombre;
            }

          });

          document.getElementById("text_nombre").innerHTML=s_sprint.nombre;
        }
        
      });
    }
</script>

@stop