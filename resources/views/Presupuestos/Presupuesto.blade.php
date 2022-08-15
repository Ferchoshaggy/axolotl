@extends('adminlte::page')

@section('title', 'Presupuesto')

@section('content_header')
<div><h1><center>PRESUPUESTO</center></h1></div>
@if (isset($proyectos))
<!--este es para el selected2 -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" >

<!-- estos son para la tabla-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">

@if (Session::has('message'))
<br>
<div class="alert alert-{{ Session::get('color') }}" role="alert" style="font-weight: bold;">
    {{ Session::get('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

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

</style>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
            <thead style="background:rgb(245, 187, 198); color:black;">
                  <tr>
                    <th  style="text-align: center;">Costo de desarrollo</th>
                    <th  style="text-align: center;">Total de egresos</th>
                    <th  style="text-align: center;">G.Individual</th>
                    <th  style="text-align: center;">G.Semanal</th>
                    <th  style="text-align: center;">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($presupuestos as $presupuesto)
                      <tr class="marca">
                        <td style="text-align: center;">
                          <?php $contador_sprints=0; $valor_total=0;?>
                          @foreach($modulos as $modulo)
                          @foreach($sprints as $sprint)
                          @if($sprint->id_modulo==$modulo->id)
                          <?php $contador_sprints++;?>
                          @endif
                          @endforeach
                          @endforeach
                          $<?php $valor_total=$presupuesto->costo*$contador_sprints; echo $valor_total; ?></td>
                        <td style="text-align: center;">
                          <?php $cantidad_egresos=1; $total_egresos=$presupuesto->egreso;?>
                          @foreach($egresos as $egreso)
                          @if($egreso->id_presupuesto==$presupuesto->id)
                          <?php $total_egresos+=$egreso->egreso;$cantidad_egresos++; ?>
                          @endif
                          @endforeach
                          ${{$total_egresos}}
                        </td>
                        <td style="text-align: center;">
                          <?php $individual=($valor_total-$total_egresos)/$presupuesto->integrantes; ?>
                          ${{$individual}}
                        </td>
                        <td style="text-align: center;">
                          <?php echo "$".$individual/$presupuesto->semanas; ?>
                        </td>
                        <td style="text-align: center;">
                          <button class="btn boton_rosa" data-toggle="modal" data-target="#editar_presupuesto" onclick="pasar_datos({{$presupuesto->id}});">ACTUALIZAR</button>
                        </td>
                      </tr>
                      @empty
                          <style>
                              .flex {
                                  animation-duration: 3s;
                                  animation-name: slidein;
                              }

                              @keyframes slidein {
                                  from {
                                      margin-left: 100%;
                                      width: 300%
                                  }

                                  to {
                                      margin-left: 0%;
                                      width: 100%;
                                  }
                              }
                          </style>
                          <tr>
                              <td></td>
                              <td></td>
                              <td style="text-align: center;"><label class="flex"> No Exiten Registros
                                      Ahorita</label></td>
                          </tr>
                      @endforelse


                </tbody>
              </table>
        </div>
<div style="display:flex; justify-content:flex-end; margin:2% 0 0 70%;">

    <button class=" btn btn-primary" data-toggle="modal" data-target="#ModalPresupuesto" style="margin:0 0 0 4%; width: 200px;">Calcular</button>
    <a href="{{url('/pdf_presupusto')}}" target="_blank" class="btn btn-warning" style="margin:0 0 0 4%; width: 200px; color:white">PDF</a>

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
      <form method="POST" action="{{ route('guardar_presupuesto') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          
          @if (isset($proyectos))
              @foreach ($proyectos as $pro)
                  <input class="form-control" type="hidden" name="idpro"
                      value="{{ Auth::user()->id_proyecto_select }}">
              @endforeach
          @endif
          <div class="row">
            <div class="col-md-3">
          <label for="costo">Costo Por Sprint</label>
          <input type="number" name="costo" step="0.01" class="form-control" value="{{old('costo')}}">

            </div>
            <div class="col-md-3">
              <label for="integrantes">Numero de Integrantes</label>
              <input type="number" name="integrantes" class="form-control"  min="1" pattern="^[0-9]+" value="{{old('integrantes')}}">
              
            </div>
            <div class="col-md-3">
            
              <label for="semanas">Semanas de trabajo</label>
              <input type="number" name="semanas" class="form-control" value="{{$calcular}}" readonly>
              
            </div>
            <div class="col-md-3">
              <?php $contador_sprints=0; ?>
              @foreach($modulos as $modulo)
                    @foreach($sprints as $sprint)
                    @if($sprint->id_modulo==$modulo->id)
                    <?php $contador_sprints++;?>
                    @endif
                    @endforeach
                    @endforeach
              <label for="sprints">Numero de sprint's</label>
              <input type="number" name="sprints" class="form-control" value="{{$contador_sprints}}" readonly>
             
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
            <label for="Egreso">Egreso</label>
            <input type="number" name="egreso" step="0.01" class="form-control" value="{{old('egreso')}}">
            
            </div>
            <div class="col-md-6">
              <label for="concepto">Concepto del Egreso</label>
              <textarea name="concepto" class="form-control">{{old('concepto')}}</textarea>
             
            </div>
            
            <div class="col-md-3">
              <label style="visibility: hidden">--</label>
              <button type="button" class="btn btn-success form-control"  id="agregarEGR">Agregar</button>
            </div>

          </div>
          <div id=masegresos>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background: rgb(160, 47, 160); color:white;">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

      </form>
    </div>
  </div>
</div>


<!-- Modal actualizar Presupuesto-->
<div class="modal fade bd-example-modal-lg" id="editar_presupuesto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titulo_edit">Actualizar Presupuesto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('actualizar_presupuesto') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          
          <div class="row">
            <div class="col-md-3">
          <label for="costo">Costo Por Sprint</label>
          <input type="number" name="costo" id="costo" step="0.01" class="form-control" value="{{old('costo')}}">

            </div>
            <div class="col-md-3">
              <label for="integrantes">Numero de Integrantes</label>
              <input type="number" name="integrantes" id="integrantes" class="form-control"  min="1" pattern="^[0-9]+" value="{{old('integrantes')}}">
              
            </div>
            <div class="col-md-3">
            
              <label for="semanas">Semanas de trabajo</label>
              <input type="number" name="semanas" class="form-control" value="{{$calcular}}" readonly>
              
            </div>
            <div class="col-md-3">
              <?php $contador_sprints=0; ?>
              @foreach($modulos as $modulo)
                    @foreach($sprints as $sprint)
                    @if($sprint->id_modulo==$modulo->id)
                    <?php $contador_sprints++;?>
                    @endif
                    @endforeach
                    @endforeach
              <label for="sprints">Numero de sprint's</label>
              <input type="number" name="sprints" class="form-control" value="{{$contador_sprints}}" readonly>
             
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
            <label for="Egreso">Egreso</label>
            <input type="number" name="egreso" id="egreso" step="0.01" class="form-control" value="">
            
            </div>
            <div class="col-md-6">
              <label for="concepto">Concepto del Egreso</label>
              <textarea name="concepto" id="concepto" class="form-control">{{old('concepto')}}</textarea>
             
            </div>
            
            <div class="col-md-3">
              <label style="visibility: hidden">--</label>
              <button type="button" class="btn btn-success form-control"  id="agregarEGR_2">Agregar</button>
            </div>

          </div>
          <div id=masegresos_2>
          </div>

        </div>
        <div class="modal-footer">
          <input type="hidden" name="id_presupuesto" id="id_presupuesto">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background: rgb(160, 47, 160); color:white;">Cancelar</button>
          <button type="submit" class="btn btn-primary">Actualizar</button>
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
</script>

<!-- Campos dinamicos de PE-AF -->

<script type="text/javascript">
  $(function () { 
    var i = 0;
    $('#agregarEGR').click(function (e) {
      e.preventDefault();
        i++;
$('#masegresos').append('<div class="row" id="newRow'+i+'">'
+'<div class="col-md-3" >'
+'<label for="Egreso">Egreso</label>'
+'<input type="number" name="egresos[]" step="0.01" class="form-control">'
+'</div>'
+'<div class="col-md-6">'
+'<label for="concepto">Concepto del Egreso</label>'
+'<textarea name="conceptos[]" class="form-control"></textarea>'
+'</div>'   
+'<div class="col-md-3">'
+'<label style="visibility: hidden">--</label>'
+'<button type="button" class="remove-lnk btn btn-outline-danger form-control" id="'+i+'">Eliminar</button>'
+'</div>'
+'</div>'

        );  
    });

     $(document).on('click', '.remove-lnk', function(e) {
       e.preventDefault();
        var id = $(this).attr("id");
         $('#newRow'+id+'').remove();
      });

  });

</script>



<script type="text/javascript">
var j = 0;
  $(function () { 
    
    $('#agregarEGR_2').click(function (e) {
      e.preventDefault();
        j++;
$('#masegresos_2').append('<div class="row" id="newRow_2'+j+'">'
+'<div class="col-md-3" >'
+'<label for="Egreso">Egreso</label>'
+'<input type="number" name="egresos[]" step="0.01" class="form-control">'
+'</div>'
+'<div class="col-md-6">'
+'<label for="concepto">Concepto del Egreso</label>'
+'<textarea name="conceptos[]" class="form-control"></textarea>'
+'</div>'   
+'<div class="col-md-3">'
+'<label style="visibility: hidden">--</label>'
+'<button type="button" class="remove-lnk_2 btn btn-outline-danger form-control" id="'+j+'">Eliminar</button>'
+'</div>'
+'</div>'

        );  
    });

     $(document).on('click', '.remove-lnk_2', function(e) {
       e.preventDefault();
        var id = $(this).attr("id");
         $('#newRow_2'+id+'').remove();
      });

  });

  function pasar_datos($id){


    $.ajax({
      url: "{{url('/search_presupuesto')}}"+'/'+$id,
      dataType: "json",
      //context: document.body
    }).done(function(s_presupuesto) {

      if(s_presupuesto==null){
        document.getElementById("costo").value=null;
        document.getElementById("integrantes").value=null;
        document.getElementById("egreso").value=null;
        document.getElementById("concepto").value=null;
        document.getElementById("id_presupuesto").value=nul;

      }else{


        $.ajax({
          url: "{{url('/search_egresos')}}"+'/'+$id,
          dataType: "json",
          //context: document.body
        }).done(function(s_egresos) {
          $('#masegresos_2').empty();
          if(s_egresos.length==0){

          }else{

            for(var i=0;i<s_egresos.length;i++){

              j++;
              $('#masegresos_2').append('<div class="row" id="newRow_2'+j+'">'
              +'<div class="col-md-3" >'
              +'<label for="Egreso">Egreso</label>'
              +'<input type="number" name="egresos[]" value="'+s_egresos[i].egreso+'" step="0.01" class="form-control">'
              +'</div>'
              +'<div class="col-md-6">'
              +'<label for="concepto">Concepto del Egreso</label>'
              +'<textarea name="conceptos[]" class="form-control">'+s_egresos[i].concepto+'</textarea>'
              +'</div>'   
              +'<div class="col-md-3">'
              +'<label style="visibility: hidden">--</label>'
              +'<button type="button" class="remove-lnk_2 btn btn-outline-danger form-control" id="'+j+'">Eliminar</button>'
              +'</div>'
              +'</div>'

                  ); 
            }

          }

        });

        document.getElementById("costo").value=s_presupuesto.costo;
        document.getElementById("integrantes").value=s_presupuesto.integrantes;
        document.getElementById("egreso").value=s_presupuesto.egreso;
        document.getElementById("concepto").value=s_presupuesto.concepto;
        document.getElementById("id_presupuesto").value=s_presupuesto.id;
      }

    });

  }

</script>

@else
<div class="card-body">
    <div style="text-align : center; ">
        <img src="{{ asset('/logos/axo.png') }}" width="30%" height="30%">
    </div>
    <div>
        <h1 style="margin-right: 0px; margin-left: 0px; margin-top: 10px; text-align : center;">No hay un Proyecto
            Seleccionado..¡¡</h1>
    </div>
</div>
@endif

@stop