<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Presupuesto</title>
    
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
        height: 1583px;
        width: 2047px;
        padding: 0;
        margin: 0x;
        background-color: rgb(255, 255, 255);
        background-image: url(./formatos/fondo_2_h.png);
        background-repeat: no-repeat;
    }

    .linea {
        border-bottom: 1px solid #ccc;
    }
</style>
<body >

<header>

<p style="font-weight: bold; padding-top: 400px; width: 100%; text-align: center; position: absolute; font-size: 50px;">Presupuesto interno para el proyecto {{$proyectos->nombre}}</p>


    <table class="table" style="border-collapse: collapse; width: 100%; font-weight: bold; margin-top: 535px;   font-size: 40px;  text-align: center;">
    <thead style="">
          <tr>
            <th style="width: 70px; "></th>
            <th style="text-align: center; font-size: 18px; background:rgb(245, 187, 198); color:black; padding: 8px;">Costo del Proyecto</th>
            <th style="text-align: center; font-size: 18px; background:rgb(245, 187, 198); color:black; padding: 8px;">No. Sprints</th>
            <th style="text-align: center; font-size: 18px; background:rgb(245, 187, 198); color:black; padding: 8px;">Costo por Sprint</th>
            <th style="text-align: center; font-size: 18px; background:rgb(245, 187, 198); color:black; padding: 8px;">Egreso</th>
            <th style="text-align: center; font-size: 18px; background:rgb(245, 187, 198); color:black; padding: 8px;">Concepto de Egreso</th>
            <th style="text-align: center; font-size: 18px; background:rgb(245, 187, 198); color:black; padding: 8px;">Total de Egresos</th>
            <th style="text-align: center; font-size: 18px; background:rgb(245, 187, 198); color:black; padding: 8px;">No. integrantes</th>
            <th style="text-align: center; font-size: 18px; background:rgb(245, 187, 198); color:black; padding: 8px;">Ganancia Total</th>
            <th style="text-align: center; font-size: 18px; background:rgb(245, 187, 198); color:black; padding: 8px;">Ganancia individual</th>
            <th style="text-align: center; font-size: 18px; background:rgb(245, 187, 198); color:black; padding: 8px;">Ganancia Semanal</th>
            <th style="text-align: center; font-size: 18px; background:rgb(245, 187, 198); color:black; padding: 8px;">Semanas de Desarrollo</th>
            <th style="width: 70px;"></th>
          </tr>
        </thead>
        <tbody>

            @forelse($presupuestos as $presupuesto)
            <tr  style="font-weight: 0; font-size: 18px;">
                <td></td>
                <td class="linea" style="text-align: center;  padding-top: 20px; padding-bottom: 20px;">
                    <?php $contador_sprints=0; $valor_total=0;?>
                    @foreach($modulos as $modulo)
                    @foreach($sprints as $sprint)
                    @if($sprint->id_modulo==$modulo->id)
                    <?php $contador_sprints++;?>
                    @endif
                    @endforeach
                    @endforeach
                    $<?php $valor_total=$presupuesto->costo*$contador_sprints; echo $valor_total; ?>
                </td>
                <td class="linea" style="text-align: center;">
                    <?php $contador_sprints=0; ?>
                    @foreach($modulos as $modulo)
                    @foreach($sprints as $sprint)
                    @if($sprint->id_modulo==$modulo->id)
                    <?php $contador_sprints++;?>
                    @endif
                    @endforeach
                    @endforeach
                    {{$contador_sprints}}
                </td>
                <td class="linea" style="text-align: center;">
                  {{$presupuesto->costo}}
                </td>
                <td class="linea" style="text-align: center;">
                  {{$presupuesto->egreso}}
                </td>
                <td class="linea" style="text-align: center; overflow-wrap: anywhere;">
                  {{$presupuesto->concepto}}
                </td>
                <td class="linea" style="text-align: center;">
                  <?php $cantidad_egresos=1; $total_egresos=$presupuesto->egreso;?>
                  @foreach($egresos as $egreso)
                  @if($egreso->id_presupuesto==$presupuesto->id)
                  <?php $total_egresos+=$egreso->egreso;$cantidad_egresos++; ?>
                  @endif
                  @endforeach
                  ${{$total_egresos}}
                </td>
                <td class="linea" style="text-align: center;">
                  {{$presupuesto->integrantes}}
                </td>
                <td class="linea" style="text-align: center;">
                  <?php echo "$".round($valor_total-$total_egresos,3); ?>
                </td>
                <td class="linea" style="text-align: center;">
                  <?php $individual=($valor_total-$total_egresos)/$presupuesto->integrantes; echo "$".round($individual,2);?>
                </td>
                <td class="linea" style="text-align: center;">
                  <?php echo "$".round($individual/$presupuesto->semanas,3); ?>
                </td>
                <td class="linea" style="text-align: center;">
                  {{$calcular}}
                </td>
            </tr>
            @endforeach
          
        </tbody>
      </table>

</header>


</body>

</html>



