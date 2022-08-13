@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content_header')
@stop

@section('content')
    <style type="text/css">
        .boton_rosa {
            margin: 0 3% 0 0;
            background: rgb(235, 75, 235);
            color: white;
            font-weight: bold;
        }

        .boton_rosa:hover {
            background-color: rgb(165, 48, 165);
            color: white;
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

    @if (Session::has('selec'))
        <br>
        <div class="alert alert-{{ Session::get('color') }}" role="alert" style="font-weight: bold;">
            {{ Session::get('selec') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- modal para la info de segir la gia-->
    @if (Session::get('message') != null)
        <button class="btn btn-primary" data-toggle="modal" data-target="#info_mas_modal" style="display: none;"
            id="info_mas" onclick="alerta_sonido();"></button>
        <div class="modal fade" id="info_mas_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLongTitle">INFO</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="text-align: center;">
                        <p style="color: black; white-space: pre-wrap; font-weight: bold; font-size: 35px;">SE GUARDO CON EXITO</p><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn boton_rosa" data-dismiss="modal">ACEPTAR</button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <button class="btn btn-primary" data-toggle="modal" data-target="#info_mas_modal" style="display: none;"
            id="info_mas"></button>
    @endif

    <script type="text/javascript">
        //este es para que suene el sonido
        let sonido = new Audio("{{ url('/SD_ALERT_27.mp3') }}");

        function alerta_sonido() {
            sonido.play();
        }
    </script>

    <div class="card-body">
        <div style="text-align : center; ">
            <img src="{{ asset('/logos/index.png') }}" width="35%" height="35%">
        </div>

        <div class="row">
            <div class="col-md-6" style="margin-bottom: 20px;">
                <div class="row">

                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6">
                        <button class="btn  boton_rosa" style="width: 100%;" data-toggle="modal" data-toggle="modal"
                            data-target="#nuevo_proyecto">Nuevo Proyecto</button>
                    </div>

                </div>
            </div>

            <div class="col-md-6" style="margin-bottom: 20px;">
                <div class="row">

                    <div class="col-md-6">
                        @foreach ($proyectos as $proyecto)
                            <form action="{{ route('seleccionar_proyecto', $proyecto->id) }}" method="POST"
                                name="formulario1">
                                @csrf
                                @method('PUT')
                        @endforeach
                        <select name="proyecto" id="proyectoSelec" class="form-control" style="font-weight: bold;"
                            onchange="ProyectoSeleccionado();">
                            <option value="" style="text-align: center" disabled selected>Seleccione Proyecto</option>
                            @foreach ($proyectos as $proyecto)
                                @if (Auth::user()->id_proyecto_select == $proyecto->id)
                                    <option value="{{ $proyecto->id }}" style="text-align: center" selected>
                                        {{ $proyecto->nombre }}</option>
                                @else
                                    <option value="{{ $proyecto->id }}" style="text-align: center">{{ $proyecto->nombre }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        </form>
                    </div>
                    <div class="col-md-6">

                    </div>

                </div>
            </div>
        </div>

        <script>
            function ProyectoSeleccionado() {
                let proyectoSelec = document.getElementById('proyectoSelec');
                let proyecto = proyectoSelec.value;

                //document.getElementById('aqui').innerText= `${proyecto}`;
                document.formulario1.submit();
            }
        </script>


        <!--
        <div style="display:flex; justify-content:center; margin:0 25% 0 25%;" >
            <button class="btn form-control" style="margin:0 3% 0 0; background:rgb(235, 75, 235); color:white;">Nuevo Proyecto</button>
            <select name="" id="" class="form-control" style="margin:0 0 0 3%;">
                <option value="" style="text-align: center">Seleccione Proyecto</option>
            </select>
                                
        </div>
    -->
    </div>



    <form method="POST" action="{{ url('/guardar_proyecto') }}" id="envio_nuevo_proyecto">
        @csrf
        <!-- nuevo proyecto-->
        <div class="modal fade" id="nuevo_proyecto" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
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
                                <input type="text" name="nombre_proyecto" id="nombre_proyecto" class="form-control"
                                    onchange="activar_primero();" onkeyup="activar_primero();">
                            </div>
                            <div class="col-md-3" style="margin-bottom: 10px;">
                                <label>FECHA ENTREGA</label>
                                <input type="date" name="fecha_entrega" id="fecha_entrega" class="form-control"
                                    onchange="activar_primero();" onkeyup="activar_primero();">
                            </div>
                            <div class="col-md-3" style="margin-bottom: 10px;">
                                <label>NOMBRE CLIENTE</label>
                                <input type="text" name="cliente" id="cliente" class="form-control"
                                    onchange="activar_primero();" onkeyup="activar_primero();">
                            </div>
                            <div class="col-md-3" style="margin-bottom: 10px;">
                                <label>CONTACTO</label>
                                <input type="text" name="contacto" id="contacto" class="form-control"
                                    onchange="activar_primero();" onkeyup="activar_primero();">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="margin-bottom: 10px;">
                                <label>DESCRIPCIÓN</label>
                                <textarea class="form-control" name="description_proyecto" id="description_proyecto" onchange="activar_primero();"
                                    onkeyup="activar_primero();"></textarea>
                            </div>
                            <div class="col-md-3" style="margin-bottom: 10px;">
                                <label>NUMERO DE MODULOS</label>
                                <input type="number" name="numero_modulos" class="form-control" min="1"
                                    id="modulos_numero" onchange="activar_primero();" onkeyup="activar_primero();">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
                        <button type="button" class="btn boton_rosa" data-dismiss="modal" data-toggle="modal"
                            data-target="#modulos"
                            onclick="agregar_modulos(Number(document.getElementById('modulos_numero').value)-1);"
                            id="paso_1" disabled>SIGUIENTE</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- nuevo proyecto modulos-->
        <div class="modal fade" id="modulos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
            data-backdrop="static" style="overflow: scroll;">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">MODULOS</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            onclick="borrar_dinamic_edit()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table id="dynamic_field" style="background-color: transparent; width: 100%; height: 100%;">
                            <tr>
                                <td>

                                    <div class="row">
                                        <div class="col-md-3" style="margin-bottom: 10px;">
                                            <label>NOMBRE DEL MODULO</label>
                                            <input type="text" name="nombre_modulos[]" class="form-control"
                                                id="nombre_modulos[]" onkeypress="return event.charCode!=32"
                                                onpaste="return false" placeholder="NO SE ACEPTAN ESPACIOS"
                                                onchange="activar_segundo();" onkeyup="activar_segundo();">
                                        </div>
                                        <div class="col-md-3" style="margin-bottom: 10px;">
                                            <label>NUMERO DE SPRINT´S</label>
                                            <input type="number" name="numero_sprints[]" class="form-control"
                                                min="1" id="numero_sprints[]" onchange="activar_segundo();"
                                                onkeyup="activar_segundo();">
                                        </div>
                                        <div class="col-md-3" style="margin-bottom: 10px;">
                                            <button type="button" class="btn btn-success" style="margin-top: 30px;"
                                                onclick="agregar_modulos(1); activar_segundo();">AGREGAR</button>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                            <label>DESCRIPCIÓN</label>
                                            <textarea class="form-control" name="description_modulos[]" id="description_modulos[]" onchange="activar_segundo();"
                                                onkeyup="activar_segundo();"></textarea>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            onclick="borrar_dinamic_edit()">CANCELAR</button>
                        <button type="button" class="btn boton_rosa" data-dismiss="modal" data-toggle="modal"
                            data-target="#sprints" onclick="agregar_sprint_boton();" id="paso_2"
                            disabled>SIGUIENTE</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- nuevo proyecto sprints-->
        <div class="modal fade" id="sprints" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
            data-backdrop="static" style="overflow: scroll;">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">SPRINT´S</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            onclick="borrar_sprints_dinamicos();">
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            onclick="borrar_sprints_dinamicos();">CANCELAR</button>
                        <button class="btn boton_rosa" disabled id="paso_3">GUARDAR</button>
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
        $(document).ready(function() {
            //este activa el modal de info, si no hay mensaje de guardado entonces no hace nada.
            document.getElementById("info_mas").click();
        });

        function activar_primero() {
            if (document.getElementById("nombre_proyecto").value != "" && document.getElementById("fecha_entrega").value !=
                "" && document.getElementById("cliente").value != "" && document.getElementById("contacto").value != "" &&
                document.getElementById("description_proyecto").value != "" && document.getElementById("modulos_numero")
                .value >= 1) {
                $('#paso_1').prop('disabled', false);
            } else {
                $('#paso_1').prop('disabled', true);
            }
        }

        function activar_segundo() {
            for (var i = 0; i < $("input[id='nombre_modulos[]']").length; i++) {
                if ($("input[id='nombre_modulos[]']")[i].value != "" && $("input[id='numero_sprints[]']")[i].value >= 1 &&
                    $("textarea[id='description_modulos[]']")[i].value != "") {
                    $('#paso_2').prop('disabled', false);
                } else {
                    $('#paso_2').prop('disabled', true);
                }
            }
        }

        function activar_tercero() {
            for (var i = 0; i < $("input[id='nombre_modulos[]']").length; i++) {
                for (var j = 0; j < $("input[id='nombre_sprints_" + $("input[id='nombre_modulos[]']")[i].value + "[]']")
                    .length; j++) {
                    if ($("input[id='nombre_sprints_" + $("input[id='nombre_modulos[]']")[i].value + "[]']")[j].value !=
                        "" && $("textarea[id='description_sprint_" + $("input[id='nombre_modulos[]']")[i].value + "[]']")[j]
                        .value != "") {
                        $('#paso_3').prop('disabled', false);
                    } else {
                        $('#paso_3').prop('disabled', true);
                    }
                }
            }
        }
        var j = 1;

        function agregar_modulos(numero) {

            for (var i = 0; i < numero; i++) {

                if (j > 0) {
                    $("#dynamic_field").append('<tr id="fila_a' + j +
                        '"><td><div class="row"><div class="col-md-3" style="margin-bottom: 10px;"><label>NOMBRE DEL MODULO</label><input type="text" name="nombre_modulos[]" id="nombre_modulos[]" class="form-control" onkeypress="return event.charCode!=32" onpaste="return false" placeholder="NO SE ACEPTAN ESPACIOS" onchange="activar_segundo();" onkeyup="activar_segundo();"></div><div class="col-md-3"  style="margin-bottom: 10px;"><label>NUMERO DE SPRINT´S</label><input type="number" name="numero_sprints[]" id="numero_sprints[]" class="form-control" min="1" onchange="activar_segundo();" onkeyup="activar_segundo();"></div><div class="col-md-3"  style="margin-bottom: 10px;"><button type="button" class="btn btn-danger remove_1" id="' +
                        j +
                        '" style="margin-top: 30px;" onclick="activar_segundo();">ELIMINAR</button></div></div><div class="row"><div class="col-md-12"  style="margin-bottom: 10px;"><label>DESCRIPCIÓN</label><textarea class="form-control" name="description_modulos[]" onchange="activar_segundo();" onkeyup="activar_segundo();" id="description_modulos[]"></textarea></div></div></td></tr>'
                        );
                    j++;

                }

            }

        }

        $(document).on('click', '.remove_1', function() {
            var id = $(this).attr("id");
            $('#fila_a' + id + '').remove();
            //j--;
        });

        //son mis arreglos para contar cuantos sprints debe de llevar cada modulo y cuantos lleva agregados, 
        var numero_sprint_modulo = [];
        var sprint_contador_por_modulo = [];

        function agregar_sprint_boton() {

            //recorreomos cualquier arreglo ya que simpre existiran los mismos 
            for (var i = 0; i < $("input[id='nombre_modulos[]']").length; i++) {
                //pasamos cuantos sprint tendra cada modulo por eso se uso un arreglo
                numero_sprint_modulo[i] = $("input[id='numero_sprints[]']")[i].value;

                //inicializamos el contador de numero de esprint
                sprint_contador_por_modulo[i] = 1;
                //hacemos un for como maximo el numero de spints que se le indico a al arreglo anterioro mente 
                for (var m = 0; m < numero_sprint_modulo[i]; m++) {

                    //este solo es para que cree la tabla y el primer registro con el boton de agregar
                    if (m == 0) {
                        $("#contenedor_tablas").append('<table id="dynamic_field_' + $("input[id='nombre_modulos[]']")[i]
                            .value + '" style="background-color: transparent; width: 100%; height: 100%;"></table>');

                        //el nombre de la tabla es dinamico y lo conseguimos mediante el nombre del modulo, practicamente casda modulo tiene su propia tabla
                        // tambien con el arreglo le damos un identificador a los componentes para saber cuales spints le toca a cdad modulo ala hora de guardad tambien los componentes se les agrega el nombre del modulo junto con el id
                        $("#dynamic_field_" + $("input[id='nombre_modulos[]']")[i].value).append('<tr id="' + $(
                                "input[id='nombre_modulos[]']")[i].value + sprint_contador_por_modulo[i] +
                            '"><td><div class="row"><div class="col-md-12" style="text-align: center; font-size: 20px;"><label style="font-weight: bold;">MODULO: <label style="font-weight: bold; color: red;">' +
                            $("input[id='nombre_modulos[]']")[i].value +
                            '</label></label></div><div class="col-md-3" style="margin-bottom: 10px;"><label>NOMBRE DEL SPRINT´S</label><input type="text" name="nombre_sprints_' +
                            $("input[id='nombre_modulos[]']")[i].value + '[]" id="nombre_sprints_' + $(
                                "input[id='nombre_modulos[]']")[i].value +
                            '[]" class="form-control" onchange="activar_tercero();" onkeyup="activar_tercero();"></div><div class="col-md-3"  style="margin-bottom: 10px;"><button type="button" class="btn btn-success" style="margin-top: 30px;" onclick="agregar_sprint_boton_interno(' +
                            i +
                            '); activar_tercero();">AGREGAR</button></div></div><div class="row"><div class="col-md-12"  style="margin-bottom: 10px;"><label>DESCRIPCIÓN</label><textarea class="form-control" name="description_sprint_' +
                            $("input[id='nombre_modulos[]']")[i].value + '[]" id="description_sprint_' + $(
                                "input[id='nombre_modulos[]']")[i].value +
                            '[]" onchange="activar_tercero();" onkeyup="activar_tercero();"></textarea></div></div></td></tr>'
                            );

                        sprint_contador_por_modulo[i]++;

                    }
                    //este es para agregar mas pero con el boton de borrar
                    if (m > 0) {

                        $("#dynamic_field_" + $("input[id='nombre_modulos[]']")[i].value).append('<tr id="' + $(
                                "input[id='nombre_modulos[]']")[i].value + sprint_contador_por_modulo[i] +
                            '"><td><div class="row"><div class="col-md-3" style="margin-bottom: 10px;"><label>NOMBRE DEL SPRINT´S</label><input type="text" name="nombre_sprints_' +
                            $("input[id='nombre_modulos[]']")[i].value + '[]" id="nombre_sprints_' + $(
                                "input[id='nombre_modulos[]']")[i].value +
                            '[]" class="form-control" onchange="activar_tercero();" onkeyup="activar_tercero();"></div><div class="col-md-3"  style="margin-bottom: 10px;"><button type="button" class="btn btn-danger" id="" style="margin-top: 30px;" onclick="borrar_dinamic_interno(' +
                            sprint_contador_por_modulo[i] + ',' + i +
                            '); activar_tercero();">ELIMINAR</button></div></div><div class="row"><div class="col-md-12"  style="margin-bottom: 10px;"><label>DESCRIPCIÓN</label><textarea class="form-control" name="description_sprint_' +
                            $("input[id='nombre_modulos[]']")[i].value + '[]" id="description_sprint_' + $(
                                "input[id='nombre_modulos[]']")[i].value +
                            '[]" onchange="activar_tercero();" onkeyup="activar_tercero();"></textarea></div></div></td></tr>'
                            );

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
            if (sprint_contador_por_modulo[indice] > 0) {

                $("#dynamic_field_" + $("input[id='nombre_modulos[]']")[indice].value).append('<tr id="' + $(
                        "input[id='nombre_modulos[]']")[indice].value + sprint_contador_por_modulo[indice] +
                    '"><td><div class="row"><div class="col-md-3" style="margin-bottom: 10px;"><label>NOMBRE DEL SPRINT´S</label><input type="text" name="nombre_sprints_' +
                    $("input[id='nombre_modulos[]']")[indice].value + '[]" id="nombre_sprints_' + $(
                        "input[id='nombre_modulos[]']")[indice].value +
                    '[]" class="form-control" onchange="activar_tercero();" onkeyup="activar_tercero();"></div><div class="col-md-3"  style="margin-bottom: 10px;"><button type="button" class="btn btn-danger" style="margin-top: 30px;" onclick="borrar_dinamic_interno(' +
                    sprint_contador_por_modulo[indice] + ',' + indice +
                    '); activar_tercero();">ELIMINAR</button></div></div><div class="row"><div class="col-md-12"  style="margin-bottom: 10px;"><label>DESCRIPCIÓN</label><textarea class="form-control" name="description_sprint_' +
                    $("input[id='nombre_modulos[]']")[indice].value + '[]" id="description_sprint_' + $(
                        "input[id='nombre_modulos[]']")[indice].value +
                    '[]" onchange="activar_tercero();" onkeyup="activar_tercero();"></textarea></div></div></td></tr>');

                sprint_contador_por_modulo[indice]++;

            }

        }

        //este se activa con el boton de eliminar que contiene cada componente, le pasamos el numero que identifica a ese componente y el indice del arreglo para saber a que tabla pertenece y poder borrarlo
        function borrar_dinamic_interno(numero_identificador_sprint, indice2) {
            //alert(sprint_contador_por_modulo[indice2]);
            //alert($("input[id='nombre_modulos[]']")[indice2].value+indice);
            $('#' + $("input[id='nombre_modulos[]']")[indice2].value + numero_identificador_sprint).remove();
            //sprint_contador_por_modulo[indice2]--;
            //alert(sprint_contador_por_modulo[indice2]);
        }

        //esta es para borrar todos los componentes de la tabla de modulos 
        function borrar_dinamic_edit() {
            for (var z = 0; z <= j; z++) {
                $('#fila_a' + z + '').remove();
            }
            j = 1;

            document.getElementById("envio_nuevo_proyecto").reset();
        }

        //esta es para borrar todas las tablas creadas de los sprints, esto se debe de hacer primero que la de eliminar modulos ya que meditante los modulos puedo hacer la eliminacion de las tablas de los sprint, una vez se borren estos ya puedo borrar los modulos
        function borrar_sprints_dinamicos() {

            for (var i = 0; i < $("input[id='nombre_modulos[]']").length; i++) {
                //como comente cada taba se identifica mediante el nombre del modulo
                $('#dynamic_field_' + $("input[id='nombre_modulos[]']")[i].value).remove();
            }
            //reinico los arreglos para evitar errores de conteo al reiniciar
            numero_sprint_modulo = [];
            sprint_contador_por_modulo = [];

            borrar_dinamic_edit();
        }


        //AJAX PARA COLOCAR PROYECTO
    </script>

@stop
