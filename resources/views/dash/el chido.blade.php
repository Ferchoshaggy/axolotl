@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content_header')
@stop

@section('content')
<style type="text/css">
    
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

</style>

@if(Session::has('message'))
<div class="alert alert-{{ Session::get('color') }}" role="alert" style="font-weight: bold;">
   {{ Session::get('message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<div class="card-body">
    <div style="text-align : center; ">
            <img src="{{ asset('/logos/index.png') }}" width="35%" height="35%">
    </div>

    <div class="row" >
        <div class="col-md-6" style="margin-bottom: 20px;">
            <div class="row">
                
                <div class="col-md-6">
                
                </div>
                <div class="col-md-6">
                    <button class="btn  boton_rosa" style="width: 100%;" data-toggle="modal" data-toggle="modal" data-target="#nuevo_proyecto">Nuevo Proyecto</button>
                </div>

            </div>
        </div>

        <div class="col-md-6" style="margin-bottom: 20px;">
            <div class="row">
                
                <div class="col-md-6">
                    <select name="" id="" class="form-control" style="font-weight: bold;" >
                        <option value="" style="text-align: center" disabled selected>Seleccione Proyecto</option>
                        @foreach($proyectos as $proyecto)
                        @if(Auth::user()->id_proyecto_select==$proyecto->id)
                        <option value="{{$proyecto->id}}" style="text-align: center" selected>{{$proyecto->nombre}}</option>
                        @else
                        <option value="{{$proyecto->id}}" style="text-align: center" >{{$proyecto->nombre}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    
                </div>

            </div>
        </div>
    </div>
<!--
    <div style="display:flex; justify-content:center; margin:0 25% 0 25%;" >
        <button class="btn form-control" style="margin:0 3% 0 0; background:rgb(235, 75, 235); color:white;">Nuevo Proyecto</button>
        <select name="" id="" class="form-control" style="margin:0 0 0 3%;">
            <option value="" style="text-align: center">Seleccione Proyecto</option>
        </select>
                            
    </div>
-->
</div>



<form method="POST" action="{{url('/guardar_proyecto')}}" id="envio_nuevo_proyecto">
    @csrf
    <!-- nuevo proyecto-->
    <div class="modal fade" id="nuevo_proyecto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">NUEVO PROYECTO</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-3" style="margin-bottom: 10px;">
                    <label>NOMBRE PROYECTO</label>
                    <input type="text" name="nombre_proyecto" class="form-control">
                </div>
                <div class="col-md-3"  style="margin-bottom: 10px;">
                    <label>FECHA ENTREGA</label>
                    <input type="date" name="fecha_entrega" class="form-control">
                </div>
                <div class="col-md-3"  style="margin-bottom: 10px;">
                    <label>NOMBRE CLIENTE</label>
                    <input type="text" name="cliente" class="form-control">
                </div>
                <div class="col-md-3"  style="margin-bottom: 10px;">
                    <label>CONTACTO</label>
                    <input type="text" name="contacto" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12"  style="margin-bottom: 10px;">
                    <label>DESCRIPCIÓN</label>
                    <textarea class="form-control" name="description_proyecto"></textarea>
                </div>
                <div class="col-md-3"  style="margin-bottom: 10px;">
                    <label>NUMERO DE MODULOS</label>
                    <input type="number" name="numero_modulos" class="form-control" min="1" id="modulos_numero">
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
            <button type="button" class="btn boton_rosa" data-dismiss="modal" data-toggle="modal" data-target="#modulos" onclick="agregar_modulos(Number(document.getElementById('modulos_numero').value)-1);">SIGUIENTE</button>
          </div>
        </div>
      </div>
    </div>

    <!-- nuevo proyecto modulos-->
    <div class="modal fade" id="modulos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" style="overflow: scroll;">
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
                                <input type="text" name="nombre_modulos[]" class="form-control" id="nombre_modulos[]" onkeypress="return event.charCode!=32" onpaste="return false" placeholder="NO SE ACEPTAN ESPACIOS">
                            </div>
                            <div class="col-md-3"  style="margin-bottom: 10px;">
                                <label>NUMERO DE SPRINT´S</label>
                                <input type="number" name="numero_sprints[]" class="form-control" min="1" id="numero_sprints[]">
                            </div>
                            <div class="col-md-3"  style="margin-bottom: 10px;">
                                <button type="button" class="btn btn-success" style="margin-top: 30px;" onclick="agregar_modulos(1);">AGREGAR</button>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12"  style="margin-bottom: 10px;">
                                <label>DESCRIPCIÓN</label>
                                <textarea class="form-control" name="description_modulos[]"></textarea>
                            </div>
                        </div>
                        
                    </td>
                </tr>
            </table>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="borrar_dinamic_edit()">CANCELAR</button>
            <button type="button" class="btn boton_rosa" data-dismiss="modal" data-toggle="modal" data-target="#sprints" onclick="agregar_sprint_boton();">SIGUIENTE</button>
          </div>
        </div>
      </div>
    </div>

    <!-- nuevo proyecto sprints-->
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
                                <input type="text" name="nombre_sprints[]" class="form-control">
                            </div>
                            <div class="col-md-3"  style="margin-bottom: 10px;">
                                <button type="button" class="btn btn-success" style="margin-top: 30px;">AGREGAR</button>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12"  style="margin-bottom: 10px;">
                                <label>DESCRIPCIÓN</label>
                                <textarea class="form-control" name="description_sprint[]"></textarea>
                            </div>
                        </div>
                        
                    </td>
                </tr>
            
            </table>
            -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="borrar_sprints_dinamicos();">CANCELAR</button>
            <button class="btn boton_rosa" disabled>GUARDAR</button>
          </div>
        </div>
      </div>
    </div>
    
</form>

@stop

@section('css')
    
@stop

@section('js')

<script type="text/javascript">
    var j=1;

    function agregar_modulos(numero){

        for(var i=0;i<numero;i++){

            if(j>0){
                $("#dynamic_field").append('<tr id="fila_a'+j+'"><td><div class="row"><div class="col-md-3" style="margin-bottom: 10px;"><label>NOMBRE DEL MODULO</label><input type="text" name="nombre_modulos[]" id="nombre_modulos[]" class="form-control" onkeypress="return event.charCode!=32" onpaste="return false" placeholder="NO SE ACEPTAN ESPACIOS"></div><div class="col-md-3"  style="margin-bottom: 10px;"><label>NUMERO DE SPRINT´S</label><input type="number" name="numero_sprints[]" id="numero_sprints[]" class="form-control" min="1"></div><div class="col-md-3"  style="margin-bottom: 10px;"><button type="button" class="btn btn-danger remove_1" id="'+j+'" style="margin-top: 30px;">ELIMINAR</button></div></div><div class="row"><div class="col-md-12"  style="margin-bottom: 10px;"><label>DESCRIPCIÓN</label><textarea class="form-control" name="description_modulos[]"></textarea></div></div></td></tr>');
                j++;

            }

        }

    }

    $(document).on('click', '.remove_1', function(){
        var id=$(this).attr("id"); 
        $('#fila_a'+id+'').remove();
        //j--;
    });

    var numero_sprint_modulo=[];
    var sprint_contador_por_modulo=[];

    function agregar_sprint_boton() {
        for(var i=0;i<$("input[id='nombre_modulos[]']").length;i++){
            numero_sprint_modulo[i]=$("input[id='numero_sprints[]']")[i].value;

            //inicializamos el contador de numero de esprint
            sprint_contador_por_modulo[i]=1;
            for( var m=0;m<numero_sprint_modulo[i]-1;m++){

                if(sprint_contador_por_modulo[i]==1){
                    $("#contenedor_tablas").append('<table id="dynamic_field_'+$("input[id='nombre_modulos[]']")[i].value+'" style="background-color: transparent; width: 100%; height: 100%;"></table>');

                    $("#dynamic_field_"+$("input[id='nombre_modulos[]']")[i].value).append('<tr id="'+$("input[id='nombre_modulos[]']")[i].value+sprint_contador_por_modulo[i]+'"><td><div class="row"><div class="col-md-12" style="text-align: center; font-size: 20px;"><label style="font-weight: bold;">MODULO: <label style="font-weight: bold; color: red;">'+$("input[id='nombre_modulos[]']")[i].value+'</label></label></div><div class="col-md-3" style="margin-bottom: 10px;"><label>NOMBRE DEL SPRINT´S</label><input type="text" name="nombre_sprints_'+$("input[id='nombre_modulos[]']")[i].value+'[]" class="form-control"></div><div class="col-md-3"  style="margin-bottom: 10px;"><button type="button" class="btn btn-success" style="margin-top: 30px;" onclick="agregar_sprint_boton_interno('+i+');">AGREGAR</button></div></div><div class="row"><div class="col-md-12"  style="margin-bottom: 10px;"><label>DESCRIPCIÓN</label><textarea class="form-control" name="description_sprint_'+$("input[id='nombre_modulos[]']")[i].value+'[]"></textarea></div></div></td></tr>');

                    sprint_contador_por_modulo[i]++;

                }
                if(sprint_contador_por_modulo[i]>0){

                    $("#dynamic_field_"+$("input[id='nombre_modulos[]']")[i].value).append('<tr id="'+$("input[id='nombre_modulos[]']")[i].value+sprint_contador_por_modulo[i]+'"><td><div class="row"><div class="col-md-3" style="margin-bottom: 10px;"><label>NOMBRE DEL SPRINT´S</label><input type="text" name="nombre_sprints_'+$("input[id='nombre_modulos[]']")[i].value+'[]" class="form-control"></div><div class="col-md-3"  style="margin-bottom: 10px;"><button type="button" class="btn btn-danger" id="" style="margin-top: 30px;" onclick="borrar_dinamic_interno('+sprint_contador_por_modulo[i]+','+i+');">ELIMINAR</button></div></div><div class="row"><div class="col-md-12"  style="margin-bottom: 10px;"><label>DESCRIPCIÓN</label><textarea class="form-control" name="description_sprint_'+$("input[id='nombre_modulos[]']")[i].value+'[]"></textarea></div></div></td></tr>');

                    sprint_contador_por_modulo[i]++;

                }
            }
        }
    }

    function agregar_sprint_boton_interno(indice) {

        if(sprint_contador_por_modulo[indice]>0){

                    $("#dynamic_field_"+$("input[id='nombre_modulos[]']")[indice].value).append('<tr id="'+$("input[id='nombre_modulos[]']")[indice].value+sprint_contador_por_modulo[indice]+'"><td><div class="row"><div class="col-md-3" style="margin-bottom: 10px;"><label>NOMBRE DEL SPRINT´S</label><input type="text" name="nombre_sprints_'+$("input[id='nombre_modulos[]']")[indice].value+'[]" class="form-control"></div><div class="col-md-3"  style="margin-bottom: 10px;"><button type="button" class="btn btn-danger" style="margin-top: 30px;" onclick="borrar_dinamic_interno('+sprint_contador_por_modulo[indice]+','+indice+');">ELIMINAR</button></div></div><div class="row"><div class="col-md-12"  style="margin-bottom: 10px;"><label>DESCRIPCIÓN</label><textarea class="form-control" name="description_sprint_'+$("input[id='nombre_modulos[]']")[indice].value+'[]"></textarea></div></div></td></tr>');

                    sprint_contador_por_modulo[indice]++;

                }

    }

    $(document).on('click', '.remove_1', function(){
        var id=$(this).attr("id"); 
        $('#fila_a'+id+'').remove();
        //j--;
    });

    function borrar_dinamic_interno(indice,indice2){
        alert(sprint_contador_por_modulo[indice2]);
        //alert($("input[id='nombre_modulos[]']")[indice2].value+indice);
        $('#'+$("input[id='nombre_modulos[]']")[indice2].value+indice).remove();
        sprint_contador_por_modulo[indice2]--;
        alert(sprint_contador_por_modulo[indice2]);
    }

    function borrar_dinamic_edit(){
        for(var z=0;z<=j;z++){
          $('#fila_a'+z+'').remove();
        }
        j=1;

        document.getElementById("envio_nuevo_proyecto").reset();
    }

    function borrar_sprints_dinamicos(){

        for(var i=0;i<$("input[id='nombre_modulos[]']").length;i++){
            $('#dynamic_field_'+$("input[id='nombre_modulos[]']")[i].value).remove();
        }
        numero_sprint_modulo=[];
        sprint_contador_por_modulo=[];

        borrar_dinamic_edit();
    }

</script>
    
@stop