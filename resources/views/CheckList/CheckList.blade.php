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

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    @if (Session::get('tipo_menu') == 1 || Session::get('tipo_menu') == null)
    <a class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true" style="font-weight: bold; color: black;" >FUNCIONALES</a>
    @else
    <a class="nav-link" id="home-tab" data-toggle="tab" data-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true" style="font-weight: bold; color: black;" >FUNCIONALES</a>
    @endif
  </li>
  <li class="nav-item" role="presentation">
    @if (Session::get('tipo_menu') == 2)
    <a class="nav-link active" id="profile-tab" data-toggle="tab" data-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false"  style="font-weight: bold; color: black;" >NO FUNCIONALES</a>
    @else
    <a class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false"  style="font-weight: bold; color: black;" >NO FUNCIONALES</a>
    @endif
  </li>
  <li class="nav-item" role="presentation">
    @if (Session::get('tipo_menu') == 3)
    <a class="nav-link active" id="contact-tab" data-toggle="tab" data-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false"  style="font-weight: bold; color: black;">SEGURIDAD</a>
    @else
    <a class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false"  style="font-weight: bold; color: black;">SEGURIDAD</a>
    @endif
  </li>
  <li class="nav-item" role="presentation">
    @if (Session::get('tipo_menu') == 4)
    <a class="nav-link active" id="contact-tab-2" data-toggle="tab" data-target="#contact-tab-pane-2" type="button" role="tab" aria-controls="contact-tab-pane-2" aria-selected="false"  style="font-weight: bold; color: black;">GENERAR</a>
    @else
    <a class="nav-link" id="contact-tab-2" data-toggle="tab" data-target="#contact-tab-pane-2" type="button" role="tab" aria-controls="contact-tab-pane-2" aria-selected="false"  style="font-weight: bold; color: black;">GENERAR</a>
    @endif
  </li>
</ul>

<!-- menu desplegable-->
<div class="tab-content card" id="myTabContent" style="background-color: #FFFFFF;">

  <!--funcinales-->
  @if (Session::get('tipo_menu') == 1  || Session::get('tipo_menu') == null)
  <div class="card-body tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
  @else
  <div class="card-body tab-pane fade" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
  @endif
    <button style="margin: 20px; " class="btn btn-primary"  data-toggle="modal" data-target="#nuevo" onclick="tipo_formulario(1);">NUEVO</button>
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
          @forelse($check_lists as $check_list)
          @if($check_list->tipo==1)
          <tr>
            <td style="text-align: center;">{{$check_list->prueba}}</td>
            <td style="text-align: center;">{{$check_list->caracteristicas}}</td>
            <td style="text-align: center;">{{$check_list->funciona}}</td>
            <td style="text-align: center;">{{$check_list->observaciones}}</td>
            <td style="text-align: center;">
              <form method="POST" action="{{url('/Eliminar_Check_List')}}">
                @csrf
                @method('DELETE')
                <input type="hidden" name="tipo_prueba_e" value="1">
                <input type="hidden" name="id_check_list" value="{{$check_list->id}}">
                <button class="btn btn-danger">ELIMINAR</button>
              </form>
              
            </td>
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

  </div>

  <!--no funcinales-->
  @if (Session::get('tipo_menu') == 2)
  <div class="card-body tab-pane fade show active" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0" >
  @else
  <div class="card-body tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0" >
  @endif
  
    
    <button style="margin: 20px; " class="btn btn-primary"  data-toggle="modal" data-target="#nuevo" onclick="tipo_formulario(2);">NUEVO</button>
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

          @forelse($check_lists as $check_list)
          @if($check_list->tipo==2)
          <tr>
            <td style="text-align: center;">{{$check_list->prueba}}</td>
            <td style="text-align: center;">{{$check_list->caracteristicas}}</td>
            <td style="text-align: center;">{{$check_list->funciona}}</td>
            <td style="text-align: center;">{{$check_list->observaciones}}</td>
            <td style="text-align: center;">
              <form method="POST" action="{{url('/Eliminar_Check_List')}}">
                @csrf
                @method('DELETE')
                <input type="hidden" name="tipo_prueba_e" value="2">
                <input type="hidden" name="id_check_list" value="{{$check_list->id}}">
                <button class="btn btn-danger">ELIMINAR</button>
              </form>
            </td>
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

  </div>

  <!--seguridad-->
  @if (Session::get('tipo_menu') == 3)
  <div class="card-body tab-pane fade show active" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
  @else
  <div class="card-body tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
  @endif
  

    <button style="margin: 20px; " class="btn btn-primary"  data-toggle="modal" data-target="#nuevo" onclick="tipo_formulario(3);">NUEVO</button>
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

          @forelse($check_lists as $check_list)
          @if($check_list->tipo==3)
          <tr>
            <td style="text-align: center;">{{$check_list->prueba}}</td>
            <td style="text-align: center;">{{$check_list->caracteristicas}}</td>
            <td style="text-align: center;">{{$check_list->funciona}}</td>
            <td style="text-align: center;">{{$check_list->observaciones}}</td>
            <td style="text-align: center;">
              <form method="POST" action="{{url('/Eliminar_Check_List')}}">
                @csrf
                @method('DELETE')
                <input type="hidden" name="tipo_prueba_e" value="3">
                <input type="hidden" name="id_check_list" value="{{$check_list->id}}">
                <button class="btn btn-danger">ELIMINAR</button>
              </form>
            </td>
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

  </div>
  <!--general-->
  @if (Session::get('tipo_menu') == 4)
  <div class="card-body tab-pane fade show active" id="contact-tab-pane-2" role="tabpanel" aria-labelledby="contact-tab-2" tabindex="0">
  @else
  <div class="card-body tab-pane fade" id="contact-tab-pane-2" role="tabpanel" aria-labelledby="contact-tab-2" tabindex="0">
  @endif
  

    <div class="col-md-12" style="text-align: center;">
      <img src="{{url('logos/animacion.gif')}}" style="border-radius: 100%; width: 40%; height: auto;" >
    </div>
    <div class="col-md-12" style="text-align: center; margin-top: 20px;">
      <button class="btn btn-primary" style="margin-right: 20px;" data-toggle="modal" data-target="#generar_link">GENERAR</button>
      @if($links!=null)
      <a href="{{url('')}}/Check_List_Question/{{$links->id}}?proyect_name={{$proyectos->nombre}}&id_proyect={{$proyectos->id}}" target="_blank" class="btn boton_rosa" style="margin-right: 20px;">VER</a>
      @if($links->contestado=="si")
      <button class="btn btn-warning" style="color:white; margin-right: 20px;" data-toggle="modal" data-target="#ver_pdf">PDF</button>
      @else
      <button class="btn " style="color:black; margin-right: 20px;" disabled>PDF</button>
      @endif
      @else
      <a class="btn " style="margin-right: 20px;" >VER</a>
      <button class="btn " style="color:black; margin-right: 20px;" disabled>PDF</button>
      @endif

     
    </div>
  </div>

</div>



<!--nueva pregunta este sera ocupada para todas -->

<div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Nueva Prueba Funcional</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('/Guardar_Preguntas')}}">
        @csrf
        <div class="modal-body">
          <table id="dynamic_field" style="background-color: transparent; width: 100%; height: 100%;">
            <tr>
              <td>

                <div class="row">
                  <div class="col-md-3">
                    <label>Prueba</label>
                    <input type="text" name="prueba[]" id="prueba[]" class="form-control" required>
                  </div>

                  <div class="col-md-3">
                    <label>Caracteristicas</label>
                    <input type="text" name="caracteristicas[]" id="caracteristicas[]" class="form-control" required>
                  </div>

                  <div class="col-md-3">
                    <label>Modulo</label>
                    <select name="Modulo0" id="Modulo0" class="form-control" required onchange="detectar_cambio_select_modulo(this);">
                      <option value="" disabled selected>.:Selecciona un modulo:.</option>
                      @foreach($modulos as $modulo)
                        <option value="{{$modulo->id}}">{{$modulo->nombre}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-md-3">
                    <div class="row">

                      <div class="col-md-10">
                        <label>Sprint</label>
                        <select class="form-control" name="sprint0" id="sprint0">
                        </select>
                      </div>
                      <div class="col-md-2">
                        <button type="button" class="btn btn-success" style="margin-top: 30px; font-weight: bold;" onclick=" agregar_prueba();">+</button>
                      </div>
                      
                    </div>
                  </div>
                  
                </div>

              </td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="cantidad_select" id="cantidad_select">
          <input type="hidden" name="tipo_prueba" id="tipo_prueba">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" >CERRAR</button>
          <button class="btn boton_rosa">GUARDAR</button>
        </div>

      </form>
    </div>
  </div>
</div>


<!--generar link -->

<div class="modal fade" id="generar_link" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Generar Link</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @if($links==null)
      <form method="POST" action="{{url('/Generar_Link')}}">
      @else
      <form method="POST" action="{{url('/Actualizar_Link')}}">
      @endif
        @csrf
        <div class="modal-body">
          @if($links==null)
          <div class="col-md-12" style="text-align: center;"> 
            <label style="font-size: 25px;">Crear el acceso al cuestionario de este proyecto</label><br>
          </div>
          @else
          <div class="col-md-12" style="text-align: center;">
            @if($links->contestado=="si")
            <label style="color: green; font-size: 25px;">YA LO CONTESTO EL USUARIO</label><br>
            @endif
            <label>Desactivar el cuestionario de este proyecto</label><br>
            @if($links->estado=="activo")
            <label style="margin-right: 20px;">Si <input type="radio" name="activador" value="activo" checked></label>
            <label>No <input type="radio" name="activador" value="desactivado" ></label>
            @else
            <label style="margin-right: 20px;">Si <input type="radio" name="activador" value="activo"></label>
            <label>No <input type="radio" name="activador" value="desactivado" checked></label>
            @endif
            
          </div>
          <div class="col-md-12" style="text-align: center;">
            <label>Link de acceso</label><br>
            <textarea disabled style="width: 100%;">{{url('')}}/Check_List_Question/{{$links->id}}?proyect_name={{$proyectos->nombre}}&id_proyect={{$proyectos->id}} </textarea>
          </div>
          @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" >CERRAR</button>
          @if($links==null)
          <button class="btn boton_rosa">GUARDAR</button>
          @else
          <button class="btn boton_rosa">ACTUALIZAR</button>
          @endif
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
            <a class="btn btn-success" target="_blank" href="{{url('/PDF_Check_List')}}">¡VAMOS! <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/><path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/></svg></a>
        </div>
        <embed type="application/pdf" src="{{url('/PDF_Check_List')}}" style="width:100%; height: 600px;">

          
          
        
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

  var j=1;
  var contador=0;
  function agregar_prueba(){

          if(j>0){
              $("#dynamic_field").append('<tr id="fila_a'+j+'"><td><div class="row"><div class="col-md-3"><label>Prueba</label><input type="text" name="prueba[]" id="prueba[]" class="form-control" required></div><div class="col-md-3"><label>Caracteristicas</label><input type="text" name="caracteristicas[]" id="caracteristicas[]" class="form-control" required></div><div class="col-md-3"><label>Modulo</label><select name="Modulo'+j+'" id="Modulo'+j+'" class="form-control" required onchange="detectar_cambio_select_modulo_interno(this,'+j+');"><option value="" disabled selected>.:Selecciona un modulo:.</option>@foreach($modulos as $modulo)<option value="{{$modulo->id}}">{{$modulo->nombre}}</option>@endforeach</select></div><div class="col-md-3"><div class="row"><div class="col-md-10"><label>Sprint</label><select class="form-control" name="sprint'+j+'" id="sprint'+j+'" ></select></div><div class="col-md-2"><button class="btn btn-danger remove_1" type="button" style="margin-top: 30px; font-weight: bold;" id="'+j+'">-</button></div></div></div></div></td></tr>');
              j++;
              contador++;

          }
          console.log(contador);
          document.getElementById("cantidad_select").value=contador;
  }

  $(document).on('click', '.remove_1', function(){
      var id=$(this).attr("id"); 
      $('#fila_a'+id+'').remove();
      contador--;
      //j--;
      document.getElementById("cantidad_select").value=contador;
  });

  
  function detectar_cambio_select_modulo(dato){
    $("#sprint0").empty();
    $.ajax({
      url: "{{url('/Search_Sprint_for_Modulo')}}"+'/'+dato.value,
      dataType: "json",
      //context: document.body
    }).done(function(s_sprint_m) {
      
      if(s_sprint_m.length==0){
        $("#sprint0").append('<option value="0"  selected>SIN SPRINTS</option>');
      }else{

        for(var i=0;i<s_sprint_m.length;i++){
           $("#sprint0").append('<option value="'+s_sprint_m[i].id+'">'+s_sprint_m[i].nombre+'</option>');
        }

      }

    });

  }

  function detectar_cambio_select_modulo_interno(dato,position){
    $("#sprint"+position).empty();
    $.ajax({
      url: "{{url('/Search_Sprint_for_Modulo')}}"+'/'+dato.value,
      dataType: "json",
      //context: document.body
    }).done(function(s_sprint_m) {
      
      if(s_sprint_m.length==0){
        $("#sprint"+position).append('<option value="0"  selected>SIN SPRINTS</option>');
      }else{

        for(var i=0;i<s_sprint_m.length;i++){
           $("#sprint"+position).append('<option value="'+s_sprint_m[i].id+'">'+s_sprint_m[i].nombre+'</option>');
        }

      }

    });

  }
  function tipo_formulario(tipo){
    document.getElementById("exampleModalLongTitle").innerHTML=null;
    document.getElementById("cantidad_select").value=contador;
    if (tipo==1) {
      document.getElementById("exampleModalLongTitle").innerHTML="Nueva Prueba Funcional";
      document.getElementById("tipo_prueba").value=1;
    }else if (tipo==2) {
      document.getElementById("exampleModalLongTitle").innerHTML="Nueva Prueba No Funcional";
      document.getElementById("tipo_prueba").value=2;
    }else if (tipo==3) {
      document.getElementById("exampleModalLongTitle").innerHTML="Nueva Prueba Seguridad";
      document.getElementById("tipo_prueba").value=3;
    }
  }
    

</script>

@stop