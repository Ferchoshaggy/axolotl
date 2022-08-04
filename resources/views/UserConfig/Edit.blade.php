@extends('adminlte::page')

@section('title', 'Configuración de Usuario')

@section('content_header')
<div><h1><center>CONFIGURACIÓN DE USUARIO</center></h1></div>
<!--este es para el selected2 -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" >

<!-- estos son para la tabla-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">

@stop
@section('content')
<style type="text/css">
  input[type="file"]{
        background: white;
        outline: none;
    }
    ::-webkit-file-upload-button{
      margin-top: -20px;
      margin-left: -12px;
      background: #00A1D8;
      color: white;
      height: 35px;
      border: none;
      outline: none;
      font-weight: bolder;
      cursor: pointer;
      border-radius: 5px;
    }
    ::-webkit-file-upload-button:hover{
      background: #111111;

    }
    .redondeo_img{
      margin-bottom: 20px; 
      border-radius: 100px; 
      width: 200px; 
      height: 200px;  
      box-shadow: 0 8px 8px 0 rgba(0, 0, 0, 0.15);
      transition: 1s;
    }

    .redondeo_img:hover{
      transition: 1s;
      border-radius: 10px;
      cursor: pointer;
    }
</style>

@if(Session::has('message'))
<div class="alert alert-{{ Session::get('color') }}" role="alert" style="font-weight: bold;">
  
  @if(Session::get('color')=="warning")
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
  </svg>
  @endif

  @if(Session::get('color')=="danger")
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bug-fill" viewBox="0 0 16 16">
  <path d="M4.978.855a.5.5 0 1 0-.956.29l.41 1.352A4.985 4.985 0 0 0 3 6h10a4.985 4.985 0 0 0-1.432-3.503l.41-1.352a.5.5 0 1 0-.956-.29l-.291.956A4.978 4.978 0 0 0 8 1a4.979 4.979 0 0 0-2.731.811l-.29-.956z"/>
  <path d="M13 6v1H8.5v8.975A5 5 0 0 0 13 11h.5a.5.5 0 0 1 .5.5v.5a.5.5 0 1 0 1 0v-.5a1.5 1.5 0 0 0-1.5-1.5H13V9h1.5a.5.5 0 0 0 0-1H13V7h.5A1.5 1.5 0 0 0 15 5.5V5a.5.5 0 0 0-1 0v.5a.5.5 0 0 1-.5.5H13zm-5.5 9.975V7H3V6h-.5a.5.5 0 0 1-.5-.5V5a.5.5 0 0 0-1 0v.5A1.5 1.5 0 0 0 2.5 7H3v1H1.5a.5.5 0 0 0 0 1H3v1h-.5A1.5 1.5 0 0 0 1 11.5v.5a.5.5 0 1 0 1 0v-.5a.5.5 0 0 1 .5-.5H3a5 5 0 0 0 4.5 4.975z"/>
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
    <form method="POST" action="{{url('/Actualizar_user')}}" enctype="multipart/form-data">
      @csrf
      @foreach($datos_user as $dato)
      <div class="row">
        <div class="col-md-6" style="text-align: center; margin-bottom: 10px;">
          @if($dato->foto==null)
          <img class="redondeo_img" src="https://picsum.photos/300/300" id="foto" data-toggle="modal" data-toggle="modal" data-target="#ver_foto"><br>
          <label>SIN FOTO, SE TE OTORGA UNA ALEATORIA</label><br>
          <label>PARA CAMBIARLA SOLO AGREGA UNA NUEVA  &nbsp;  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
          </svg></label>
          <input type="file" name="foto" class="form-control" accept="image/png" id="foto_archivo" onchange="cambio_foto(this);">
          @else
          <img class="redondeo_img" src="fotos_users\{{$dato->foto}}" id="foto" data-toggle="modal" data-toggle="modal" data-target="#ver_foto"><br>
          <label>FOTO ACTUAL, PUEDES CAMBIARLA</label><br>
          <label>PARA CAMBIARLA SOLO AGREGA UNA NUEVA  &nbsp;  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
          </svg></label>
          <input type="file" name="foto" class="form-control" accept="image/png" id="foto_archivo" onchange="cambio_foto(this);">
          @endif
        </div>

        <div class="col-md-6" >
          <div class="row">
            
            <div class="col-md-4" style="margin-bottom: 10px;">
              <label>NOMBRE</label>
              <input type="text" name="nombre" class="form-control" placeholder="NOMBRE USUARIO" required value="{{$dato->name}}" onkeyup="this.value = this.value.toUpperCase();">
            </div>
            <div class="col-md-4" style="margin-bottom: 10px;">
              <label>APELLIDO PATERNO</label>
              <input type="text" name="ape_pat" class="form-control" placeholder="APELLIDO PATERNO" required value="{{$dato->ape_pat}}" onkeyup="this.value = this.value.toUpperCase();">
            </div>
            <div class="col-md-4" style="margin-bottom: 10px;">
              <label>APELLIDO MATERNO</label>
              <input type="text" name="ape_mat" class="form-control" placeholder="APELLIDO MATERNO" required value="{{$dato->ape_mat}}" onkeyup="this.value = this.value.toUpperCase();">
            </div>

          </div>

          <div class="row">
            
            <div class="col-md-4" style="margin-bottom: 10px;">
              <label>EDAD</label>
              <input type="number" name="edad" class="form-control" placeholder="minima de 10" min="10" required value="{{$dato->edad}}">
            </div>
            <div class="col-md-8" style="margin-bottom: 10px;">
              <label>DIRECCIÓN</label>
              <input type="text" name="direccion" class="form-control" placeholder="DIRECCIÓN SEA LO MAS SIMPLE POR FAVOR" required value="{{$dato->direccion}}">
            </div>
            

          </div>

          <div class="row">
            
            <div class="col-md-6" style="margin-bottom: 10px;">
              <label>CORREO</label>
              <input type="text" name="correo" class="form-control" placeholder="CORREO" required value="{{$dato->email}}">
            </div>
            <div class="col-md-6" style="margin-bottom: 10px;">
              <label>CONTRASEÑA NUEVA</label>
              <div class="input-group mb-3">
                <input type="password" name="contrasena" class="form-control" placeholder="AGREGA SI DESEAS CAMBIAR" aria-label="AGREGA SI DESEAS CAMBIAR" aria-describedby="button-addon2" id="contra" minlength="8" value="">

                <button class="btn btn-outline-dark" type="button" id="button-addon2" onclick="ver_contrasena();">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                    <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                    <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/>
                  </svg>
                </button>

              </div>
            </div>

          </div>
          
          <div class="col-md-12" style="margin-bottom: 10px; text-align: center;">
            <button class="btn btn-warning" style="font-weight: bold;">ACTUALIZAR</button>
          </div>
        </div>

      </div>
      @endforeach
      

    </form>
    
  </div>
</div>

<!-- vsita imagen-->
<div class="modal fade" id="ver_foto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">IMAGEN ACTUAL</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align: center;">
        @if($dato->foto==null)
          <img src="https://picsum.photos/300/300"  id="foto_2" width="80%" height="80%"><br>
          @else
          <img  src="fotos_users\{{$dato->foto}}"  id="foto_2" width="80%" height="80%"><br>
          @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ACEPTAR</button>
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

  function ver_contrasena(){

    if(document.getElementById("contra").type=="password"){

      document.getElementById("contra").type="text";

      document.getElementById("button-addon2").innerHTML='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"> <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/> <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/> </svg>';

    }else{

      document.getElementById("contra").type="password";
      document.getElementById("button-addon2").innerHTML='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16"> <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/> <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/> </svg>';
    }
  }

  function cambio_foto(file){
    if(file.files[0]==null){
      document.getElementById("foto").src="https://picsum.photos/300/300";
      document.getElementById("foto_2").src="https://picsum.photos/300/300";
      
    }else{
      document.getElementById("foto").src= (window.URL ? URL : webkitURL).createObjectURL(file.files[0]);
      document.getElementById("foto_2").src= (window.URL ? URL : webkitURL).createObjectURL(file.files[0]);
      
    }
  }

</script>

@stop