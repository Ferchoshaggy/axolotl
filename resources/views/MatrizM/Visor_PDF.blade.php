<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Matriz Master</title>
    
</head>
<style type="text/css">
    *{
        margin: 0;
        padding: 0;
            
        }

    body{   

    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
    }
    header{
        width: 1275px;
        height: 1650px;
        padding: 0;
        margin: 0x;
        background-color: rgb(255, 255, 255);
        background-image: url(./formatos/Membrete.jpg);
        background-repeat: no-repeat;
    }

    .linea {
        border-bottom: 1px solid #ccc;
    }
</style>
<body >

<header>

<p style="font-weight: bold; padding-top: 335px;  padding-left: 150px; position: absolute; font-size: 40px;">Matriz Master</p>


    <table class="table" style="border-collapse: collapse; width: 100%; font-weight: bold; padding-top: 435px;  position: absolute; font-size: 40px;  text-align: center;">
    <thead style="">
          <tr>
            <th style="width: 70px; "></th>
            <th style="text-align: center; font-size: 28px; background:rgb(245, 187, 198); color:black; padding: 8px;">Clave</th>
            <th style="text-align: center; font-size: 28px; background:rgb(245, 187, 198); color:black; padding: 8px;">Sprint</th>
            <th style="text-align: center; font-size: 28px; background:rgb(245, 187, 198); color:black; padding: 8px;">Descripcion</th>
            <th style="text-align: center; font-size: 28px; background:rgb(245, 187, 198); color:black; padding: 8px;">Avance</th>
            <th style="width: 70px;"></th>
          </tr>
        </thead>
        <tbody>
          <?php $contador_modulos=1; $contador_parar_tabla=1;?>
          @foreach($modulos as $modulo)
          <?php $contador_sprints=1; ?>
          @foreach($sprints as $sprint)
          @if($sprint->id_modulo==$modulo->id && $contador_parar_tabla<=11)
          @if($sprint->porcentaje<100)
          <tr title="MODULO: {{$modulo->nombre}}" class="marca" style="font-weight: 0; ">
            <td></td>
            <td style="text-align: center; font-size: 12px; font-size: 18px; padding-top: 15px; padding-bottom: 15px;" class="linea">{{$contador_modulos}}.{{$contador_sprints}}</td>
            <td style="text-align: center; font-size: 12px; font-size: 18px;"  class="linea">{{$sprint->nombre}}</td>
            <td style="text-align: center; font-size: 12px; font-size: 18px;" class="linea">{{$sprint->descripcion}}</td>
            <td style="text-align: center; font-size: 12px; font-size: 18px;" class="linea">{{$sprint->porcentaje}}%</td>
            <td></td>
          </tr>
          @endif
          <?php $contador_sprints++; $contador_parar_tabla++;?>
          @endif
          @endforeach
          <?php $contador_modulos++;?>
          @endforeach
        </tbody>
      </table>

@if($contador_parar_tabla>=10)
<label style="font-weight: bold; margin-top: 1045px;   position: absolute; width: 100%; text-align: center;">EXISTEN MAS SPRINTS PERO YA NO CABEN EN LA TABLA, IGUAL LOS SPRINTS QUE ESTAN AL 100% YA NO APARECERÁN</label>
@endif




<footer style="font-weight: bold; margin-top: 1080px;   position: absolute; width: 100%; text-align: center;">
<?php

            $total_proyecto=0;
            $suma_porcentaje_por_modulo_unitario=0;
            $porcentaje_por_modulo=0;
            $sumatoria_modulo=0;
            echo '<img src="https://quickchart.io/chart?c={type:\'doughnut\',data:{labels:[';


            foreach ($modulos as $modulo) {
                $sumatoria_modulo++;
                echo "'".$modulo->nombre."',";
            }

            
            $porcentaje_por_modulo=(100/$sumatoria_modulo);

            echo '],datasets:[{data:[';
            $i=0;
            foreach ($modulos as $modulo) {
                $numero_sprints=0;
                $sumatoria_sprints=0;
                $porcentaje_por_modulo_unitario=0;
                foreach ($sprints as $sprint) {
                    if($sprint->id_modulo==$modulo->id){
                        $numero_sprints++;
                        $sumatoria_sprints+=$sprint->porcentaje;
                    }
                }
                if($numero_sprints==0){
                    $divicion = 0;
                }else{
                    $divicion = $sumatoria_sprints / $numero_sprints;
                }
                $porcentaje_por_modulo_unitario=($divicion*$porcentaje_por_modulo)/$porcentaje_por_modulo;
                $suma_porcentaje_por_modulo_unitario+=$porcentaje_por_modulo_unitario;
                //impresion de datos
                echo round($porcentaje_por_modulo_unitario,3).","; 
                $i++;
            }

$result=$suma_porcentaje_por_modulo_unitario/$sumatoria_modulo;

            echo ']}]},
options:{
    plugins:{

        datalabels: {

            display: true,
            backgroundColor: \'rgb(255, 255, 255)\',
            borderRadius: 3,
            font: {
              color: \'red\',
              weight: \'bold\',
            },
            

        },


        doughnutlabel:{
            labels:[{
                text:\''.$result.'%\',
                font:{
                    size:20,
                    weight: \'bold\'
                }
                },
                {text:\''.$proyectos->nombre.'\'
            }]
        }
    }

}}" width="60%" >';

             


           


 ?>

</footer>

</header>


</body>

</html>



