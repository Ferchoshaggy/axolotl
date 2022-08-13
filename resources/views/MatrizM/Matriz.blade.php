@extends('adminlte::page')

@section('title', 'Matriz Master')

@section('content_header')
<div><h1><center>MATRIZ MASTER</center></h1></div>
@if (isset($proyectos))
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
<div class="alert alert-{{ Session::get('color') }}" role="alert" style="font-weight: bold;">

  @if(Session::get('color')=="success")
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-node-plus-fill" viewBox="0 0 16 16">
  <path d="M11 13a5 5 0 1 0-4.975-5.5H4A1.5 1.5 0 0 0 2.5 6h-1A1.5 1.5 0 0 0 0 7.5v1A1.5 1.5 0 0 0 1.5 10h1A1.5 1.5 0 0 0 4 8.5h2.025A5 5 0 0 0 11 13zm.5-7.5v2h2a.5.5 0 0 1 0 1h-2v2a.5.5 0 0 1-1 0v-2h-2a.5.5 0 0 1 0-1h2v-2a.5.5 0 0 1 1 0z"/>
  </svg>
  @endif

  @if(Session::get('color')=="warning")
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
  </svg>
  @endif

  @if(Session::get('color')=="danger")
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
  </svg>
  @endif



   {{ Session::get('message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif


<div class="card">
    <div class="card-body">

      <div class="row">

          <div class="col-md-12" style="margin-top: 20px; margin-bottom: 20px; ">
            <button class="btn btn-success" data-toggle="modal" data-target="#menu_agregar" style="width: 200px; margin-right: 30px; margin-bottom: 10px;">Agregar</button>
            <button class="btn boton_morado" data-toggle="modal" data-target="#menu_ediciones" style="width: 200px; margin-right: 30px; margin-bottom: 10px;">Editar</button>
            <button class="btn btn-danger" data-toggle="modal" data-target="#menu_eliminar" style="width: 200px; margin-right: 30px; margin-bottom: 10px;">Eliminar</button>
            <button class="btn btn-warning"  data-toggle="modal" data-target="#ver_pdf" style="color: white; width: 200px; margin-right: 30px; margin-bottom: 10px;">PDF</button>

          </div>
          
        </div>

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
            <input type="number" class="form-control" name="porcentaje" id="porcentaje_sprint" min="0" max="100" step="any" aria-label="Amount (to the nearest dollar)" required>
            <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-percent" viewBox="0 0 16 16"><path d="M13.442 2.558a.625.625 0 0 1 0 .884l-10 10a.625.625 0 1 1-.884-.884l10-10a.625.625 0 0 1 .884 0zM4.5 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm7 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/></svg></span>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id_sprint" id="id_sprint">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" >CANCELAR</button>
          <button class="btn boton_rosa" >ACTUALIZAR</button>
        </div>

      </form>
    </div>
  </div>
</div>


<!--Modal que quieres editar -->

<div class="modal fade" id="menu_ediciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">¿QUE QUIERES HACER?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12" style="margin-bottom: 10px; text-align: center;">
          <button class="btn btn-info" style="width: 100%;" data-toggle="modal" data-target="#editar_proyecto" data-dismiss="modal">EDITAR DATOS DEL PROYECTO</button>
        </div>
        <div class="col-md-12" style="margin-bottom: 10px;">
          <button class="btn btn-warning" style="width: 100%;" data-toggle="modal" data-target="#editar_modulo" data-dismiss="modal" onclick="datos_modulo();">EDITAR MODULO</button>
        </div>
        <div class="col-md-12" style="margin-bottom: 10px;">
          <button class="btn btn-primary" style="width: 100%;" data-toggle="modal" data-target="#editar_sprint" data-dismiss="modal" onclick="seleccion_sprint();">EDITAR SPRINT</button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" >CERRAR</button>
      </div>
    </div>
  </div>
</div>


<!--Modal que quieres agregar -->

<div class="modal fade" id="menu_agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">¿QUE QUIERES HACER?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="col-md-12" style="margin-bottom: 10px;">
          <button class="btn btn-success" style="width: 100%;" data-toggle="modal" data-target="#agregar_modulo" data-dismiss="modal">AGREGAR MODULO</button>
        </div>
        <div class="col-md-12" style="margin-bottom: 10px;">
          <button class="btn btn-primary" style="width: 100%;" data-toggle="modal" data-target="#agregar_sprint" data-dismiss="modal" onclick="datos_modulo_sprint();">AGREGAR SPRINT</button>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" >CERRAR</button>
      </div>
    </div>
  </div>
</div>


<!--Modal que quieres eliminar -->

<div class="modal fade" id="menu_eliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">¿QUE QUIERES HACER?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="col-md-12" style="margin-bottom: 10px;">
          <button class="btn btn-danger" style="width: 100%;" data-toggle="modal" data-target="#eliminar_modulo" data-dismiss="modal" onclick="select_delete_modulo();">ELIMINAR MODULO</button>
        </div>
        <div class="col-md-12" style="margin-bottom: 10px;">
          <button class="btn btn-secondary" style="width: 100%;" data-toggle="modal" data-target="#eliminar_sprint" data-dismiss="modal" onclick="select_delete_sprint();">ELIMINAR SPRINT</button>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" >CERRAR</button>
      </div>
    </div>
  </div>
</div>



<!--Modal editar proyecto-->
<div class="modal fade" id="editar_proyecto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">ACTUALIZAR DATOS DEL PROYECTO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="document.getElementById('envio_proyecto_edit').reset();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('/actualizar_proyecto')}}" id="envio_proyecto_edit">
        @csrf
        <div class="modal-body">
          <div class="row">
              <div class="col-md-3" style="margin-bottom: 10px;">
                  <label>NOMBRE PROYECTO</label>
                  <input type="text" name="nombre_proyecto" id="nombre_proyecto" class="form-control" required value="{{$proyectos->nombre}}">
              </div>
              <div class="col-md-3"  style="margin-bottom: 10px;">
                  <label>FECHA ENTREGA</label>
                  <input type="date" name="fecha_entrega" id="fecha_entrega" class="form-control" required value="{{$proyectos->entrega}}">
              </div>
              <div class="col-md-3"  style="margin-bottom: 10px;">
                  <label>NOMBRE CLIENTE</label>
                  <input type="text" name="cliente" id="cliente" class="form-control" required value="{{$proyectos->cliente}}">
              </div>
              <div class="col-md-3"  style="margin-bottom: 10px;">
                  <label>CONTACTO</label>
                  <input type="text" name="contacto" id="contacto" class="form-control" required value="{{$proyectos->contacto}}">
              </div>
          </div>
          <div class="row">
              <div class="col-md-12"  style="margin-bottom: 10px;">
                  <label>DESCRIPCIÓN</label>
                  <textarea class="form-control" name="description_proyecto" id="description_proyecto" required>{{$proyectos->descripcion}}</textarea>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="document.getElementById('envio_proyecto_edit').reset();">CANCELAR</button>
          <button class="btn boton_rosa" >ACTUALIZAR</button>
        </div>
        
      </form>
    </div>
  </div>
</div>


<!--Modal editar modulos-->
<div class="modal fade" id="editar_modulo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">ACTUALIZAR DATOS DEL MODULO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('/actualizar_modulo')}}" >
        @csrf
        <div class="modal-body">
          <div class="col-md-12" style="text-align: center; margin-bottom: 20px;">
            <label>SELECCIONE EL MODULO A EDITAR</label>
            <select class="form-control" name="id_modulo_select" id="id_modulo_select" onchange="datos_modulo();">
              @foreach($modulos as $modulo)
              <option value="{{$modulo->id}}">{{$modulo->nombre}}</option>
              @endforeach
            </select>
          </div>
          
          <div class="row">
              <div class="col-md-3" style="margin-bottom: 10px;">
                  <label>NOMBRE DEL MODULO</label>
                  <input type="text" name="nombre_modulo_e" id="nombre_modulo_e" class="form-control" >
              </div>
              <div class="col-md-9" style="margin-bottom: 10px;">
                  <label style="margin-top: 40px;">*puedes cambiar el nombre con espacios si gustas</label>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12"  style="margin-bottom: 10px;">
                  <label>DESCRIPCIÓN</label>
                  <textarea class="form-control" name="description_modulo_e" id="description_modulo_e"></textarea>
              </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id_modulo_e" id="id_modulo_e">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
          <button class="btn boton_rosa" >ACTUALIZAR</button>
        </div>

      </form>
    </div>
  </div>
</div>

<!--Modal editar sprint-->
<div class="modal fade" id="editar_sprint" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">ACTUALIZAR DATOS DEL SPRINT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('/actualizar_sprint')}}" >
        @csrf
        <div class="modal-body">
          <div class="col-md-12" style="text-align: center; margin-bottom: 20px;">
            <label>SELECCIONE EL SPRINT A EDITAR</label>
            <select class="form-control" name="id_sprint_select" id="id_sprint_select" onchange="seleccion_sprint();">
              @foreach($modulos as $modulo)
              @foreach($sprints as $sprint)
              @if($sprint->id_modulo==$modulo->id)
              <option value="{{$sprint->id}}">{{$sprint->nombre}}</option>
              @endif
              @endforeach
              @endforeach
            </select>
          </div>
          
          <div class="row">
              <div class="col-md-3" style="margin-bottom: 10px;">
                  <label>NOMBRE DEL SPRINT</label>
                  <input type="text" name="nombre_sprint_e" id="nombre_sprint_e" class="form-control" >
              </div>
          </div>
          <div class="row">
              <div class="col-md-12"  style="margin-bottom: 10px;">
                  <label>DESCRIPCIÓN</label>
                  <textarea class="form-control" name="description_sprint_e" id="description_sprint_e"></textarea>
              </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id_sprint_e" id="id_sprint_e">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
          <button class="btn boton_rosa" >ACTUALIZAR</button>
        </div>

      </form>
    </div>
  </div>
</div>

<form method="POST" action="{{url('/guardar_modulos')}}" id="envio_modulos">
    @csrf
    <!-- nuevo modulos-->
    <div class="modal fade" id="agregar_modulo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" style="overflow: scroll;">
      <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">MODULOS</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="borrar_dinamic_edit()">
              <span aria-hidden="true" >&times;</span>
            </button>
          </div>
          <div class="modal-body" >
            <table id="dynamic_field" style="background-color: transparent; width: 100%; height: 100%;">
                <tr>
                    <td>

                        <div class="row">
                            <div class="col-md-3" style="margin-bottom: 10px;">
                                <label>NOMBRE DEL MODULO</label>
                                <input type="text" name="nombre_modulos[]" class="form-control" id="nombre_modulos[]" onkeypress="return event.charCode!=32" onpaste="return false" placeholder="NO SE ACEPTAN ESPACIOS" onchange="activar_segundo();" onkeyup="activar_segundo();">
                            </div>
                            <div class="col-md-3"  style="margin-bottom: 10px;">
                                <label>NUMERO DE SPRINT´S</label>
                                <input type="number" name="numero_sprints[]" class="form-control" min="1" id="numero_sprints[]" onchange="activar_segundo();" onkeyup="activar_segundo();">
                            </div>
                            <div class="col-md-3"  style="margin-bottom: 10px;">
                                <button type="button" class="btn btn-success" style="margin-top: 30px;" onclick="agregar_modulos(1); activar_segundo();">AGREGAR</button>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12"  style="margin-bottom: 10px;">
                                <label>DESCRIPCIÓN</label>
                                <textarea class="form-control" name="description_modulos[]" id="description_modulos[]" onchange="activar_segundo();" onkeyup="activar_segundo();"></textarea>
                            </div>
                        </div>
                        
                    </td>
                </tr>
            </table>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="borrar_dinamic_edit()">CANCELAR</button>
            <button type="button" class="btn boton_rosa" data-dismiss="modal" data-toggle="modal" data-target="#sprints" onclick="agregar_sprint_boton();" id="paso_2" disabled>SIGUIENTE</button>
          </div>
        </div>
      </div>
    </div>

    <!-- nuevo con modulo sprints-->
    <div class="modal fade" id="sprints" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" style="overflow: scroll;">
      <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">SPRINT´S</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="borrar_sprints_dinamicos();">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="contenedor_tablas">
            <!--
            <table id="dynamic_field_2" style="background-color: transparent; width: 100%; height: 100%;">
                
                <tr>
                    <td>

                        <div class="row">
                            <div class="col-md-12" style="text-align: center; font-size: 20px;">
                                    <label style="font-weight: bold;">MODULO: <label style="font-weight: bold; color: red;">sdnjkf</label></label>
                            </div>
                            <div class="col-md-3" style="margin-bottom: 10px;">
                                <label>NOMBRE DEL SPRINT´S</label>
                                <input type="text" name="nombre_sprints[]" id="nombre_sprints[]" class="form-control">
                            </div>
                            <div class="col-md-3"  style="margin-bottom: 10px;">
                                <button type="button" class="btn btn-success" style="margin-top: 30px;">AGREGAR</button>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12"  style="margin-bottom: 10px;">
                                <label>DESCRIPCIÓN</label>
                                <textarea class="form-control" name="description_sprint[]" id="description_sprint[]"></textarea>
                            </div>
                        </div>
                        
                    </td>
                </tr>
            
            </table>
            -->
          </div>
          <div class="modal-footer">
            <input type="hidden" name="id_proyecto_a_modulos" value="{{$proyectos->id}}">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="borrar_sprints_dinamicos();">CANCELAR</button>
            <button class="btn boton_rosa" disabled id="paso_3">GUARDAR</button>
          </div>
        </div>
      </div>
    </div>
    
</form>


<!-- nuevo sprints-->
<div class="modal fade" id="agregar_sprint" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" style="overflow: scroll;">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">SPRINT´S</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="borrar_sprints_dinamicos();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form method="POST" action="{{url('/agregar_sprints')}}">
        @csrf
        <div class="modal-body" id="contenedor_tablas_2">

          <div class="col-md-12" style="text-align: center; margin-bottom: 20px;">
            <label>SELECCIONE EL MODULO AL CUAL AGREGARAS LOS SPRINTS</label>
            <select class="form-control" name="id_modulo_select_2" id="id_modulo_select_2" onchange="datos_modulo_sprint();">
              @foreach($modulos as $modulo)
              <option value="{{$modulo->id}}">{{$modulo->nombre}}</option>
              @endforeach
            </select>
          </div>
          <!--
          <table id="dynamic_field_2" style="background-color: transparent; width: 100%; height: 100%;">
              
              <tr>
                  <td>

                      <div class="row">
                          <div class="col-md-12" style="text-align: center; font-size: 20px;">
                                  <label style="font-weight: bold;">MODULO: <label style="font-weight: bold; color: red;">sdnjkf</label></label>
                          </div>
                          <div class="col-md-3" style="margin-bottom: 10px;">
                              <label>NOMBRE DEL SPRINT´S</label>
                              <input type="text" name="nombre_sprints[]" id="nombre_sprints[]" class="form-control">
                          </div>
                          <div class="col-md-3"  style="margin-bottom: 10px;">
                              <button type="button" class="btn btn-success" style="margin-top: 30px;">AGREGAR</button>
                          </div>
                          
                      </div>
                      <div class="row">
                          <div class="col-md-12"  style="margin-bottom: 10px;">
                              <label>DESCRIPCIÓN</label>
                              <textarea class="form-control" name="description_sprint[]" id="description_sprint[]"></textarea>
                          </div>
                      </div>
                      
                  </td>
              </tr>
          
          </table>
          -->
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id_modulo_agrega_sprit" id="id_modulo_agrega_sprit" >
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="borrar_sprints_dinamicos();">CANCELAR</button>
          <button class="btn boton_rosa" >GUARDAR</button>
        </div>

      </form>
      
    </div>
  </div>
</div>

<!-- eliminar modulo-->
<div class="modal fade" id="eliminar_modulo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">ELIMINAR MODULO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('/eliminar_modulo')}}">
        @csrf
        @method('DELETE')
        <div class="modal-body">

          <div class="col-md-12" style="text-align: center; margin-bottom: 20px;">
              <label>SELECCIONE EL MODULO A ELIMINAR</label>
              <select class="form-control" name="id_modulo_select_delete" id="id_modulo_select_delete" onchange="select_delete_modulo();">
                @foreach($modulos as $modulo)
                <option value="{{$modulo->id}}">{{$modulo->nombre}}</option>
                @endforeach
              </select>
          </div>

          <div class="col-md-12" style="text-align: center;">
            <label style=" color: #CA8815;">*SI ELIMINAS EL MODULO, SE ELIMINARAN TAMBIEN SUS SPRINTS</label>
          </div>
          
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id_modulo_delete" id="id_modulo_delete">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" >CERRAR</button>
          <button class="btn btn-danger"  >ELIMINAR</button>
        </div>

      </form>
    </div>
  </div>
</div>



<!-- eliminar sprint-->
<div class="modal fade" id="eliminar_sprint" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">ELIMINAR SPRINT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('/eliminar_sprint')}}">
        @csrf
        @method('DELETE')
        <div class="modal-body">

          <div class="col-md-12" style="text-align: center; margin-bottom: 20px;">
              <label>SELECCIONE EL SPRINT A ELIMINAR</label>
              <select class="form-control" name="id_sprint_select_delete" id="id_sprint_select_delete" onchange="select_delete_sprint();">
                @foreach($sprints as $sprint)
                <option value="{{$sprint->id}}">{{$sprint->nombre}}</option>
                @endforeach
              </select>
          </div>
          
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id_sprint_delete" id="id_sprint_delete">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" >CERRAR</button>
          <button class="btn btn-danger" >ELIMINAR</button>
        </div>

      </form>
    </div>
  </div>
</div>


<!-- ver pdf-->
<div class="modal fade" id="ver_pdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">PDF</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12" style="text-align: center;display: none;" id="no_se_mira">
            <p>UPss! &nbsp;&nbsp; !CREO QUE NO SE VE BIEN EL PDF; VAMOS A OTRA PAGINA OK!</p>
            <a class="btn btn-success" target="_blank" href="{{url('/Visor_PDF')}}">¡VAMOS! <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/><path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/></svg></a>
        </div>
        <embed type="application/pdf" src="{{url('/Visor_PDF')}}" style="width:100%; height: 600px;">

          
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" >CERRAR</button>
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

  //let navegador = navigator.userAgent;
  //console.log(navegador);
  //este es para saber que dispositivo se esta usando y mandarlo a otro lado al usuario ya que no se mira bien el pdf
  if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
    document.getElementById("no_se_mira").style.display="block";
  }else{
    console.log("No estás usando un móvil");
  }

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
          document.getElementById("text_nombre_modulo").innerHTML=null;
          document.getElementById("text_nombre").innerHTML=null;
          document.getElementById("porcentaje_sprint").placeholder=null;

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
          document.getElementById("porcentaje_sprint").placeholder=s_sprint.porcentaje+"% porcentaje actual";
          document.getElementById("text_nombre").innerHTML=s_sprint.nombre;
        }
        
      });
    }

    function datos_modulo(){
      $id_modulo=document.getElementById("id_modulo_select").value;
      $.ajax({
        url: "{{url('/Search_Modulo')}}"+'/'+$id_modulo,
        dataType: "json",
        //context: document.body
      }).done(function(s_modulo) {

        if(s_modulo==null){
          document.getElementById("id_modulo_e").value=null;
          document.getElementById("nombre_modulo_e").value=null;
          document.getElementById("description_modulo_e").innerHTML=null;
        }else{
          document.getElementById("id_modulo_e").value=s_modulo.id;
          document.getElementById("nombre_modulo_e").value=s_modulo.nombre;
          document.getElementById("description_modulo_e").innerHTML=s_modulo.descripcion;
        }

      });
    }

    function seleccion_sprint(){
      $id_sprint=document.getElementById("id_sprint_select").value;
      $.ajax({
        url: "{{url('/Search_Sprint')}}"+'/'+$id_sprint,
        dataType: "json",
        //context: document.body
      }).done(function(s_sprint) {

        if(s_sprint==null){
          document.getElementById("id_sprint_e").value=null;
          document.getElementById("nombre_sprint_e").value=null;
          document.getElementById("description_sprint_e").innerHTML=null;
        }else{
          document.getElementById("id_sprint_e").value=s_sprint.id;
          document.getElementById("nombre_sprint_e").value=s_sprint.nombre;
          document.getElementById("description_sprint_e").innerHTML=s_sprint.descripcion;
        }

      });
    }

    function select_delete_sprint(){
      $id_sprint=document.getElementById("id_sprint_select_delete").value;
      document.getElementById("id_sprint_delete").value=$id_sprint;
    }

    function select_delete_modulo(){
      $id_sprint=document.getElementById("id_modulo_select_delete").value;
      document.getElementById("id_modulo_delete").value=$id_sprint;
    }


    function activar_segundo(){
        for(var i=0;i<$("input[id='nombre_modulos[]']").length;i++){
            if($("input[id='nombre_modulos[]']")[i].value!="" && $("input[id='numero_sprints[]']")[i].value>=1 && $("textarea[id='description_modulos[]']")[i].value!=""){
                $('#paso_2').prop('disabled', false);
            }else{
                 $('#paso_2').prop('disabled', true);
            }
        }
    }
    function activar_tercero(){
        for(var i=0;i<$("input[id='nombre_modulos[]']").length;i++){
            for(var j=0;j<$("input[id='nombre_sprints_"+$("input[id='nombre_modulos[]']")[i].value+"[]']").length;j++){
                if($("input[id='nombre_sprints_"+$("input[id='nombre_modulos[]']")[i].value+"[]']")[j].value!="" && $("textarea[id='description_sprint_"+$("input[id='nombre_modulos[]']")[i].value+"[]']")[j].value!=""){
                    $('#paso_3').prop('disabled', false);
                }else{
                     $('#paso_3').prop('disabled', true);
                }
            }
        }
    }
    var j=1;

    function agregar_modulos(numero){

        for(var i=0;i<numero;i++){

            if(j>0){
                $("#dynamic_field").append('<tr id="fila_a'+j+'"><td><div class="row"><div class="col-md-3" style="margin-bottom: 10px;"><label>NOMBRE DEL MODULO</label><input type="text" name="nombre_modulos[]" id="nombre_modulos[]" class="form-control" onkeypress="return event.charCode!=32" onpaste="return false" placeholder="NO SE ACEPTAN ESPACIOS" onchange="activar_segundo();" onkeyup="activar_segundo();"></div><div class="col-md-3"  style="margin-bottom: 10px;"><label>NUMERO DE SPRINT´S</label><input type="number" name="numero_sprints[]" id="numero_sprints[]" class="form-control" min="1" onchange="activar_segundo();" onkeyup="activar_segundo();"></div><div class="col-md-3"  style="margin-bottom: 10px;"><button type="button" class="btn btn-danger remove_1" id="'+j+'" style="margin-top: 30px;" onclick="activar_segundo();">ELIMINAR</button></div></div><div class="row"><div class="col-md-12"  style="margin-bottom: 10px;"><label>DESCRIPCIÓN</label><textarea class="form-control" name="description_modulos[]" onchange="activar_segundo();" onkeyup="activar_segundo();" id="description_modulos[]"></textarea></div></div></td></tr>');
                j++;

            }

        }

    }

    $(document).on('click', '.remove_1', function(){
        var id=$(this).attr("id"); 
        $('#fila_a'+id+'').remove();
        //j--;
    });

    //son mis arreglos para contar cuantos sprints debe de llevar cada modulo y cuantos lleva agregados, 
    var numero_sprint_modulo=[];
    var sprint_contador_por_modulo=[];

    function agregar_sprint_boton() {

        //recorreomos cualquier arreglo ya que simpre existiran los mismos 
        for(var i=0;i<$("input[id='nombre_modulos[]']").length;i++){
            //pasamos cuantos sprint tendra cada modulo por eso se uso un arreglo
            numero_sprint_modulo[i]=$("input[id='numero_sprints[]']")[i].value;

            //inicializamos el contador de numero de esprint
            sprint_contador_por_modulo[i]=1;
            //hacemos un for como maximo el numero de spints que se le indico a al arreglo anterioro mente 
            for( var m=0;m<numero_sprint_modulo[i];m++){

                //este solo es para que cree la tabla y el primer registro con el boton de agregar
                if(m==0){
                    $("#contenedor_tablas").append('<table id="dynamic_field_'+$("input[id='nombre_modulos[]']")[i].value+'" style="background-color: transparent; width: 100%; height: 100%;"></table>');

                    //el nombre de la tabla es dinamico y lo conseguimos mediante el nombre del modulo, practicamente casda modulo tiene su propia tabla
                    // tambien con el arreglo le damos un identificador a los componentes para saber cuales spints le toca a cdad modulo ala hora de guardad tambien los componentes se les agrega el nombre del modulo junto con el id
                    $("#dynamic_field_"+$("input[id='nombre_modulos[]']")[i].value).append('<tr id="'+$("input[id='nombre_modulos[]']")[i].value+sprint_contador_por_modulo[i]+'"><td><div class="row"><div class="col-md-12" style="text-align: center; font-size: 20px;"><label style="font-weight: bold;">MODULO: <label style="font-weight: bold; color: red;">'+$("input[id='nombre_modulos[]']")[i].value+'</label></label></div><div class="col-md-3" style="margin-bottom: 10px;"><label>NOMBRE DEL SPRINT´S</label><input type="text" name="nombre_sprints_'+$("input[id='nombre_modulos[]']")[i].value+'[]" id="nombre_sprints_'+$("input[id='nombre_modulos[]']")[i].value+'[]" class="form-control" onchange="activar_tercero();" onkeyup="activar_tercero();"></div><div class="col-md-3"  style="margin-bottom: 10px;"><button type="button" class="btn btn-success" style="margin-top: 30px;" onclick="agregar_sprint_boton_interno('+i+'); activar_tercero();">AGREGAR</button></div></div><div class="row"><div class="col-md-12"  style="margin-bottom: 10px;"><label>DESCRIPCIÓN</label><textarea class="form-control" name="description_sprint_'+$("input[id='nombre_modulos[]']")[i].value+'[]" id="description_sprint_'+$("input[id='nombre_modulos[]']")[i].value+'[]" onchange="activar_tercero();" onkeyup="activar_tercero();"></textarea></div></div></td></tr>');

                    sprint_contador_por_modulo[i]++;

                }
                //este es para agregar mas pero con el boton de borrar
                if(m>0){

                    $("#dynamic_field_"+$("input[id='nombre_modulos[]']")[i].value).append('<tr id="'+$("input[id='nombre_modulos[]']")[i].value+sprint_contador_por_modulo[i]+'"><td><div class="row"><div class="col-md-3" style="margin-bottom: 10px;"><label>NOMBRE DEL SPRINT´S</label><input type="text" name="nombre_sprints_'+$("input[id='nombre_modulos[]']")[i].value+'[]" id="nombre_sprints_'+$("input[id='nombre_modulos[]']")[i].value+'[]" class="form-control" onchange="activar_tercero();" onkeyup="activar_tercero();"></div><div class="col-md-3"  style="margin-bottom: 10px;"><button type="button" class="btn btn-danger" id="" style="margin-top: 30px;" onclick="borrar_dinamic_interno('+sprint_contador_por_modulo[i]+','+i+'); activar_tercero();">ELIMINAR</button></div></div><div class="row"><div class="col-md-12"  style="margin-bottom: 10px;"><label>DESCRIPCIÓN</label><textarea class="form-control" name="description_sprint_'+$("input[id='nombre_modulos[]']")[i].value+'[]" id="description_sprint_'+$("input[id='nombre_modulos[]']")[i].value+'[]" onchange="activar_tercero();" onkeyup="activar_tercero();"></textarea></div></div></td></tr>');

                    //le sumamos al arreglo de numero de esprints cuantos lleva ese modulo, esto solo es para poder itentificarlos para borrarlos
                    sprint_contador_por_modulo[i]++;

                }
            }
        }
    }

    //esta funcion se activa con el bonton de agregar que tienen los sprint primeros de cada modulo
    function agregar_sprint_boton_interno(indice) {

        //este es practicamente lo mismo pero este solo es para agregar uno mas si asi lo dece el usuario
        //tambien ocupamos que se pasara el indice para saber a que tabla sera agregado el nuevo componente por eso la impirtancia de ocupar arreglos
        if(sprint_contador_por_modulo[indice]>0){

                    $("#dynamic_field_"+$("input[id='nombre_modulos[]']")[indice].value).append('<tr id="'+$("input[id='nombre_modulos[]']")[indice].value+sprint_contador_por_modulo[indice]+'"><td><div class="row"><div class="col-md-3" style="margin-bottom: 10px;"><label>NOMBRE DEL SPRINT´S</label><input type="text" name="nombre_sprints_'+$("input[id='nombre_modulos[]']")[indice].value+'[]" id="nombre_sprints_'+$("input[id='nombre_modulos[]']")[indice].value+'[]" class="form-control" onchange="activar_tercero();" onkeyup="activar_tercero();"></div><div class="col-md-3"  style="margin-bottom: 10px;"><button type="button" class="btn btn-danger" style="margin-top: 30px;" onclick="borrar_dinamic_interno('+sprint_contador_por_modulo[indice]+','+indice+'); activar_tercero();">ELIMINAR</button></div></div><div class="row"><div class="col-md-12"  style="margin-bottom: 10px;"><label>DESCRIPCIÓN</label><textarea class="form-control" name="description_sprint_'+$("input[id='nombre_modulos[]']")[indice].value+'[]" id="description_sprint_'+$("input[id='nombre_modulos[]']")[indice].value+'[]" onchange="activar_tercero();" onkeyup="activar_tercero();"></textarea></div></div></td></tr>');

                    sprint_contador_por_modulo[indice]++;

                }

    }
    //elimina e sprint agregado por tabla generada
    //este se activa con el boton de eliminar que contiene cada componente, le pasamos el numero que identifica a ese componente y el indice del arreglo para saber a que tabla pertenece y poder borrarlo
    function borrar_dinamic_interno(numero_identificador_sprint,indice2){
        //alert(sprint_contador_por_modulo[indice2]);
        //alert($("input[id='nombre_modulos[]']")[indice2].value+indice);
        $('#'+$("input[id='nombre_modulos[]']")[indice2].value+numero_identificador_sprint).remove();
        //sprint_contador_por_modulo[indice2]--;
        //alert(sprint_contador_por_modulo[indice2]);
    }

    //esta es para borrar todos los componentes de la tabla de modulos 
    function borrar_dinamic_edit(){
        for(var z=0;z<=j;z++){
          $('#fila_a'+z+'').remove();
        }
        j=1;

        document.getElementById("envio_modulos").reset();
    }

    //esta es para borrar todas las tablas creadas de los sprints, esto se debe de hacer primero que la de eliminar modulos ya que meditante los modulos puedo hacer la eliminacion de las tablas de los sprint, una vez se borren estos ya puedo borrar los modulos
    function borrar_sprints_dinamicos(){

        for(var i=0;i<$("input[id='nombre_modulos[]']").length;i++){
            //como comente cada taba se identifica mediante el nombre del modulo
            $('#dynamic_field_'+$("input[id='nombre_modulos[]']")[i].value).remove();
        }
        //reinico los arreglos para evitar errores de conteo al reiniciar
        numero_sprint_modulo=[];
        sprint_contador_por_modulo=[];

        borrar_dinamic_edit();
    }



   //estas son parecidas al las de arriba pero aqui solo es una tabla y es mas facil identificarlos

    var numero_sprint_modulo2=[];
    var nombre_modulo_s=null;
    var nombre_modulo_tabla=null;
    var sprint_contador_por_modulo2=[];

    function datos_modulo_sprint($id_modulo){

      $('#dynamic_field_2'+nombre_modulo_tabla).remove();

      sprint_contador_por_modulo2[0]=1;

      $id_modulo=document.getElementById("id_modulo_select_2").value;
      $.ajax({
        url: "{{url('/Search_Modulo')}}"+'/'+$id_modulo,
        dataType: "json",
        //context: document.body
      }).done(function(s_modulo) {

        if(s_modulo==null){
          
        }else{
          document.getElementById("id_modulo_agrega_sprit").value=s_modulo.id;
          nombre_modulo_s=s_modulo.nombre;
          nombre_modulo_tabla="tx";
          $("#contenedor_tablas_2").append('<table id="dynamic_field_2'+nombre_modulo_tabla+'" style="background-color: transparent; width: 100%; height: 100%;"></table>');

          //el nombre de la tabla es dinamico y lo conseguimos mediante el nombre del modulo, practicamente casda modulo tiene su propia tabla
          // tambien con el arreglo le damos un identificador a los componentes para saber cuales spints le toca a cdad modulo ala hora de guardad tambien los componentes se les agrega el nombre del modulo junto con el id
          $("#dynamic_field_2"+nombre_modulo_tabla).append('<tr id="'+nombre_modulo_tabla+sprint_contador_por_modulo2[0]+'"><td><div class="row"><div class="col-md-12" style="text-align: center; font-size: 20px;"><label style="font-weight: bold;">MODULO: <label style="font-weight: bold; color: red;">'+nombre_modulo_s+'</label></label></div><div class="col-md-3" style="margin-bottom: 10px;"><label>NOMBRE DEL SPRINT´S</label><input type="text" name="nombre_sprints_tx[]" id="nombre_sprints_tx[]" class="form-control"  required></div><div class="col-md-3"  style="margin-bottom: 10px;"><button type="button" class="btn btn-success" style="margin-top: 30px;" onclick="agregar_sprint_unico(); activar_tercero();">AGREGAR</button></div></div><div class="row"><div class="col-md-12"  style="margin-bottom: 10px;"><label>DESCRIPCIÓN</label><textarea class="form-control" name="description_sprint_tx[]" id="description_sprint_tx[]" required></textarea></div></div></td></tr>');

          sprint_contador_por_modulo2[0]++;
          

        }

      });

    }



    function agregar_sprint_unico(){

      $("#dynamic_field_2"+nombre_modulo_tabla).append('<tr id="'+nombre_modulo_tabla+sprint_contador_por_modulo2[0]+'"><td><div class="row"><div class="col-md-3" style="margin-bottom: 10px;"><label>NOMBRE DEL SPRINT´S</label><input type="text" name="nombre_sprints_tx[]" id="nombre_sprints_tx[]" class="form-control" required></div><div class="col-md-3"  style="margin-bottom: 10px;"><button type="button" class="btn btn-danger" style="margin-top: 30px;" onclick="borrar_sprint_interno_dinamico('+sprint_contador_por_modulo2[0]+'); ">ELIMINAR</button></div></div><div class="row"><div class="col-md-12"  style="margin-bottom: 10px;"><label>DESCRIPCIÓN</label><textarea class="form-control" name="description_sprint_tx[]" id="description_sprint_tx[]" onchange="activar_tercero();" onkeyup="activar_tercero();" required></textarea></div></div></td></tr>');

        sprint_contador_por_modulo2[0]++;

    }

    //elimina e sprint agregado al mmodulo indicado
    //este se activa con el boton de eliminar que contiene cada componente, le pasamos el numero que identifica a ese componente y el indice del arreglo para saber a que tabla pertenece y poder borrarlo
    function borrar_sprint_interno_dinamico(numero_identificador_sprint){
        //alert(sprint_contador_por_modulo[indice2]);
        //alert($("input[id='nombre_modulos[]']")[indice2].value+indice);
        $('#'+nombre_modulo_tabla+numero_identificador_sprint).remove();
        //sprint_contador_por_modulo[indice2]--;
        //alert(sprint_contador_por_modulo[indice2]);
    }
      
</script>

@else
 <div class="card-body">
    <div style="text-align : center; ">
        <img src="{{ asset('/logos/axo.png') }}" width="30%" height="30%">
</div>
<div>
    <h1 style="margin-right: 0px; margin-left: 0px; margin-top: 10px; text-align : center;">No hay un Proyecto Seleccionado..¡¡</h1>
</div>
 </div>
@endif

@stop

