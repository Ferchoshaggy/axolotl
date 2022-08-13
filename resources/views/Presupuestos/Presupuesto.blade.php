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
                  @forelse($presupuestos as $pre)
                  @if (Auth::user()->id_proyecto_select == $pre->id_proyecto)
                      <tr>
                        <th style="text-align: center;"></th>
                        <th style="text-align: center;"></th>
                        <th style="text-align: center;"></th>
                        <th style="text-align: center;"></th>
                        
                      </tr>
                 
                      @endif
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

        <form method="POST" action="{{ route('guardar_presupuesto') }}" enctype="multipart/form-data">
          @csrf

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
    </div>
  </div>
</div>
</form>

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