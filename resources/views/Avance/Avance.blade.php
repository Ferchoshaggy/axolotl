@extends('adminlte::page')

@section('title', 'Avance')

@section('content_header')


    <div>
        <h1>
            <center>AVANCE</center>
        </h1>
    </div>
    @if (isset($proyectos))
        <!--este es para el selected2 -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

        <!-- estos son para la tabla-->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">



    @stop


    @section('content')
        <style type="text/css">
            li {
                transition: .6s;
            }

            li:hover {
                font-size: 18px;
                transition: .6s;
            }

            .texto_grande {
                font-size: 25px;
                font-weight: bold;
                transition: .8s;
            }

            .texto_grande:hover {
                font-size: 35px;
                transition: .8s;
            }
        </style>

        <div class="card" id="cont">
            <div class="card-body">
                <div class="col-md-12" style="text-align: center;">
                    <p class="texto_grande" id="porcentaje_proyecto">$proyectos->nombre</p>
                    <div id="container" style="margin-right: 0px; margin-left: 0px;"></div>
                </div>

            </div>
        </div>


    @stop

    @section('css')

    @stop

    @section('js')

        <!-- son para las graficas-->
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/pattern-fill.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

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
            /*
              Highcharts.chart('container', {
                    colors: ['#01BAF2', '#71BF45', '#FAA74B', '#B37CD2'],
                    chart: {
                        type: 'pie'
                    },
                    title: {
                        text: '<p class="texto_grande">.:XXX:.</p>'
                    },
                    tooltip: {
                        valueSuffix: '%'
                    },
                    lang: {
                        downloadPNG:"Descargar en PNG",
                        downloadJPEG:"Descargar en JPEG",
                        downloadPDF:"Descargar en PDF",
                        downloadSVG:"Descargar en SVG",
                        printChart:"Imprimir Grafica",
                        exitFullscreen:"Salir de Pantalla Completa",
                        viewFullscreen:"Ver en Pantalla Completa"
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '{point.name}: {y} %'
                            },
                            showInLegend: true
                        }
                    },
                    series: [{
                        name: 'Percentage',
                        colorByPoint: false,
                        innerSize: '75%',
                        data: [{
                            name: 'MODULO www',
                            color: '#FF9300',
                            y: 10
                        }, {
                            name: 'MODULO yyy',
                            color: '#63AE00',
                            y: 25
                        }, {
                            name: 'MODULO ggg',
                            color: '#00A7C6',
                            y: 15
                        }, {
                            name: 'MODULO sss',
                            color: '#00EEDF',
                            y: 12
                        }, {
                            name: 'MODULO aaa',
                            color: '#CD56CD',
                            y: 0
                        }, {
                            name: 'MODULO bbb',
                            color: '#AEAEAE',
                            y: 2
                        }]
                    }]
                });
            */
        </script>

        <?php
        
        echo "<script type='text/javascript'>
        
        Highcharts.chart('container', {
                colors: ['#FFB6C1','#00A7C6','#B8860B','#FAFF01','#FFEBCD','#4B0082','#F0E68C','#B37CD2','#63AE00','#FF0000','#AEAEAE','#01BAF2', '#71BF45', '#FAA74B'],
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'PORCENTAJE DE CADA MODULO'
                },
                tooltip: {
                    valueSuffix: '%'
                },
                lang: {
                    downloadPNG:'Descargar en PNG',
                    downloadJPEG:'Descargar en JPEG',
                    downloadPDF:'Descargar en PDF',
                    downloadSVG:'Descargar en SVG',
                    printChart:'Imprimir Grafica',
                    exitFullscreen:'Salir de Pantalla Completa',
                    viewFullscreen:'Ver en Pantalla Completa'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}: {y} %'
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Porcentaje',
                    colorByPoint: true,
                    innerSize: '75%',
                    data: [";
        $total_proyecto = 0;
        $suma_porcentaje_por_modulo_unitario = 0;
        $porcentaje_por_modulo = 0;
        $sumatoria_modulo = 0;
        foreach ($modulos as $modulo) {
            $sumatoria_modulo++;
        }
        
        $porcentaje_por_modulo = 100 / $sumatoria_modulo;
        
        $i = 0;
        foreach ($modulos as $modulo) {
            $numero_sprints = 0;
            $sumatoria_sprints = 0;
            $porcentaje_por_modulo_unitario = 0;
            foreach ($sprints as $sprint) {
                if ($sprint->id_modulo == $modulo->id) {
                    $numero_sprints++;
                    $sumatoria_sprints += $sprint->porcentaje;
                }
            }
            if($numero_sprints==0){
                $divicion = 0;
            }else{
                $divicion = $sumatoria_sprints / $numero_sprints;
            }
            
            $porcentaje_por_modulo_unitario = ($divicion * $porcentaje_por_modulo) / $porcentaje_por_modulo;
            $suma_porcentaje_por_modulo_unitario += $porcentaje_por_modulo_unitario;
            echo "{
                        name: '$modulo->nombre',
                        
                        y: $porcentaje_por_modulo_unitario
                    }, ";
        
            $i++;
        }
        
        echo "]
                }]
        
            });
        ";
        $result = $suma_porcentaje_por_modulo_unitario / $sumatoria_modulo;
        $texto = "$proyectos->nombre $result%";
        echo "
            document.getElementById('porcentaje_proyecto').innerHTML='" .
            $texto .
            "';
        
        </script>";
        
        ?>
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
