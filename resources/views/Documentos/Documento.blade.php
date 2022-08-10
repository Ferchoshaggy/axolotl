@extends('adminlte::page')

@section('title', 'Documentos')

@section('content_header')
    <div>
        <h1>
            <center>DOCUMENTOS</center>
        </h1>
    </div>
    @if (isset($proyectos))
        <!--este es para el selected2 -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

        <!-- estos son para la tabla-->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">

        <style type="text/css">
            input[type="file"] {
                background: white;
                outline: none;
            }

            ::-webkit-file-upload-button {
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

            ::-webkit-file-upload-button:hover {
                background: #111111;

            }

            .redondeo_img {
                margin-bottom: 20px;
                border-radius: 100px;
                width: 200px;
                height: 200px;
                box-shadow: 0 8px 8px 0 rgba(0, 0, 0, 0.15);
                transition: 1s;
            }

            .redondeo_img:hover {
                transition: 1s;
                border-radius: 10px;
                cursor: pointer;
            }
        </style>

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
                                <th scope="col" style="text-align: center;">Nombre</th>
                                <th scope="col" style="text-align: center;">Descripcion</th>
                                <th scope="col" style="text-align: center;">Eliminar</th>
                                <th scope="col" style="text-align: center;">Descargar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($documentos as $doc)
                                @if (Auth::user()->id_proyecto_select == $doc->id_proyecto)
                                    <tr>
                                        <th style="text-align: center;">{{ $doc->fecha }}</th>
                                        <td style="text-align: center;">{{ $doc->nombre }}</td>
                                        <td style="text-align: center;">{{ $doc->descripcion }}</td>
                                        <td style="text-align: center;"><button class="btn"
                                                style="background: rgb(160, 47, 160); color:white;" data-toggle="modal"
                                                data-target="#modal-delete-{{ $doc->id }}">ELIMINAR
                                            </button></td>
                                        <td style="text-align: center;"><a
                                                href="{{ route('descargar_documento', $doc->uuid) }}" class="btn"
                                                style="background: rgb(226, 94, 134); color:white;">Descargar</a></td>
                                    </tr>

                                    <!-- modal eliminar -->
                                    <div class="modal fade" id="modal-delete-{{ $doc->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('eliminar_documento', $doc->id) }}" method="POST">
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
                                                        Deseas Eliminar el Documento <br> <label
                                                            style="color: red">{{ $doc->nombre }}</label>
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

                    <button class="form-control btn btn-primary" data-toggle="modal" data-target="#ModalDocumento"
                        style="margin:0 0 0 5%;">Nuevo</button>

                </div>

            </div>
        </div>
        <!-- Modal Nuevo Documento -->
        <div class="modal fade bd-example-modal-lg" id="ModalDocumento" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Nuevo Documento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('guardar_documentos') }}" enctype="multipart/form-data">
                            @csrf

                            @if (isset($proyectos))
                                @foreach ($proyectos as $pro)
                                    <input class="form-control" type="hidden" name="idpro"
                                        value="{{ Auth::user()->id_proyecto_select }}">
                                @endforeach
                            @endif

                            <div class="row">

                                <div class="col-md-4">
                                    <label for="Fecha">Fecha de Recibido</label>
                                    <input type="date" name="fecha" class="form-control">
                                    @error('fecha')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-8">
                                    <label for="documento">Documento</label>
                                    <input type="file" name="archivo" class="form-control">
                                    @error('archivo')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="Descripcion">Descripcion</label>
                                    <textarea name="descripcion" class="form-control"></textarea>
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
