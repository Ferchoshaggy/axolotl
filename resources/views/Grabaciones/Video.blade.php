@extends('adminlte::page')

@section('title', 'Grabaciones')

@section('content_header')

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

    <div>
        <h1>
            <center>GRABACIONES</center>
        </h1>
    </div>
    @if (isset($proyectos))
        <!--este es para el selected2 -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

        <!-- estos son para la tabla-->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">

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
                                <th scope="col" style="text-align: center;">Fecha</th>
                                <th scope="col" style="text-align: center;">Link</th>
                                <th scope="col" style="text-align: center;">Descripcion</th>
                                <th scope="col" style="text-align: center;">Eliminar</th>
                                <th scope="col" style="text-align: center;">Ver</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($grabaciones as $gra)
                                @if (Auth::user()->id_proyecto_select == $gra->id_proyecto)
                                    <tr class="marca">
                                        <td style="text-align: center;">{{ $gra->fecha }}</td>
                                        <td style="text-align: center;">{{ $gra->link }}</td>
                                        <td style="text-align: center;">{{ $gra->descripcion }}</td>
                                        <td style="text-align: center;"><button class="btn"
                                                style="background: rgb(160, 47, 160); color:white;" data-toggle="modal"
                                                data-target="#modal-delete-{{ $gra->id }}">ELIMINAR
                                            </button></td>
                                        <td style="text-align: center;"><a href="{{ $gra->link }}"
                                                target="_blank"><button class="btn"
                                                    style="background: rgb(226, 94, 134); color:white;">Ver</button></a>
                                        </td>
                                    </tr>
                                    <!-- modal eliminar -->
                                    <div class="modal fade" id="modal-delete-{{ $gra->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('eliminar_link', $gra->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Documento
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Deseas Eliminar el link <br> <label
                                                            style="color: red">{{ $gra->link }}</label>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn"
                                                            style="background: rgb(160, 47, 160); color:white;">Eliminar</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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
                <div style="display:flex; justify-content:flex-end; margin:2% 0 0 85%;">

                    <button class="form-control btn btn-primary" data-toggle="modal" data-target="#ModalGrabaciones"
                        style="margin:0 0 0 4%;">Nuevo</button>

                </div>

            </div>
        </div>

        <!-- Modal Nuevo Grabaciones -->
        <div class="modal fade bd-example-modal-lg" id="ModalGrabaciones" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Nueva Grabacion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form method="POST" action="{{ route('guardar_link') }}">
                            @csrf

                            @if (isset($proyectos))

                                @foreach ($proyectos as $pro)
                                    <input class="form-control" type="hidden" name="idpro"
                                        value="{{ Auth::user()->id_proyecto_select }}">
                                @endforeach

                            @endif

                            <div class="row">
                                <div class="col-md-8">
                                    <label for="link">Link</label>
                                    <input type="text" name="link" class="form-control" value="{{old('link')}}">
                                    @error('link')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="Fecha">Fecha de Grabacion</label>
                                    <input type="date" name="fecha" class="form-control" value="{{old('fecha')}}">
                                    @error('fecha')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="Descripcion">Descripcion</label>
                                    <textarea name="descripcion" class="form-control">{{old('descripcion')}}</textarea>
                                    @error('descripcion')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            style="background: rgb(160, 47, 160); color:white;">Cancelar</button>
                        @if (isset($proyectos))
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        @else
                            <button type="submit" class="btn btn-primary" disabled><abbr
                                    title="No hay Proyecto Seleccionado"> Guardar</button>
                        @endif
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
        <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js">
        </script>
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
