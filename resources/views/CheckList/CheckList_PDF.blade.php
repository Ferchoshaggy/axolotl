<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Check List</title>
    
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
        background-repeat: no-repeat;
    }

    .linea {
        border-bottom: 1px solid #ccc;
    }
    
</style>
<body >

<header>
    <img src="{{url('formatos/encabezadoCP.png')}}" style="  max-width: 1275px; height: 282px;" id="img1">
    <p style="width: 100%; font-weight: bold; font-size: 30px; margin: 20px; text-align: center;">Check List</p>
    <label style="width: 100%;  font-size: 25px; padding-right: 20px; padding-left: 20px;">Pruebas Funcionales <br><li style="width: 95%; background-color:grey; height: 2px; list-style:none; text-align: center; margin-left: 20px;"></li></label>
    <table class="table" style="border-collapse: collapse; width: 100%; font-weight: bold; margin-top: 30px;">
        <thead style="">
          <tr>
            
            <th style="width: 20%;"></th>
            <th style="width: 30%;"></th>
            <th style="width: 15%;"></th>
            <th style="width: 35%;"></th>
            
          </tr>
        </thead>
        <tbody>
            @foreach($check_lists as $check_list)
            @if($check_list->tipo==1)
            <tr>
                
                <td style="padding: 20px; overflow-wrap: anywhere;">{{$check_list->prueba}}</td>
                <td style="padding: 20px; overflow-wrap: anywhere;">{{$check_list->caracteristicas}}</td>
                <td style="text-align: center; padding: 20px;">
                    @if($check_list->funciona=="Si")
                    <label>Si <input type="radio" class="form-check-input"  style="width: 18px; height: 18px; " checked></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label>No <input type="radio" class="form-check-input"  style="width: 18px; height: 18px; " ></label>
                    @else
                    <label>Si <input type="radio" class="form-check-input"  style="width: 18px; height: 18px; " ></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label>No <input type="radio" class="form-check-input"  style="width: 18px; height: 18px; " checked></label>
                    @endif
                    
                </td>
                <td style="padding: 25px; overflow-wrap: anywhere;">
                    @if($check_list->observaciones!=null)
                    ¿Por que?<br><br>
                    {{$check_list->observaciones}}
                    @endif
                </td>
                
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>


    <!-- no funcionales -->
    <label style="width: 100%;  font-size: 25px; padding-right: 20px; padding-left: 20px;">Pruebas no Funcionales <br><li style="width: 95%; background-color:grey; height: 2px; list-style:none; text-align: center; margin-left: 20px;"></li></label>
    <table class="table" style="border-collapse: collapse; width: 100%; font-weight: bold; margin-top: 30px;">
        <thead style="">
          <tr>
            
            <th style="width: 20%;"></th>
            <th style="width: 30%;"></th>
            <th style="width: 15%;"></th>
            <th style="width: 35%;"></th>
            
          </tr>
        </thead>
        <tbody>
            @foreach($check_lists as $check_list)
            @if($check_list->tipo==2)
            <tr>
                
                <td style="padding: 20px; overflow-wrap: anywhere;">{{$check_list->prueba}}</td>
                <td style="padding: 20px; overflow-wrap: anywhere;">{{$check_list->caracteristicas}}</td>
                <td style="text-align: center; padding: 20px;">
                    @if($check_list->funciona=="Si")
                    <label>Si <input type="radio" class="form-check-input"  style="width: 18px; height: 18px; " checked></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label>No <input type="radio" class="form-check-input"  style="width: 18px; height: 18px; " ></label>
                    @else
                    <label>Si <input type="radio" class="form-check-input"  style="width: 18px; height: 18px; " ></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label>No <input type="radio" class="form-check-input"  style="width: 18px; height: 18px; " checked></label>
                    @endif
                    
                </td>
                <td style="padding: 25px; overflow-wrap: anywhere;">
                    @if($check_list->observaciones!=null)
                    ¿Por que?<br><br>
                    {{$check_list->observaciones}}
                    @endif
                </td>
                
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>

    <!-- seguridad -->
    <label style="width: 100%;  font-size: 25px; padding-right: 20px; padding-left: 20px;">Pruebas de Seguridad <br><li style="width: 95%; background-color:grey; height: 2px; list-style:none; text-align: center; margin-left: 20px;"></li></label>
    <table class="table" style="border-collapse: collapse; width: 100%; font-weight: bold; margin-top: 30px;">
        <thead style="">
          <tr>
            
            <th style="width: 20%;"></th>
            <th style="width: 30%;"></th>
            <th style="width: 15%;"></th>
            <th style="width: 35%;"></th>
            
          </tr>
        </thead>
        <tbody>
            @foreach($check_lists as $check_list)
            @if($check_list->tipo==3)
            <tr>
                
                <td style="padding: 20px; overflow-wrap: anywhere;">{{$check_list->prueba}}</td>
                <td style="padding: 20px; overflow-wrap: anywhere;">{{$check_list->caracteristicas}}</td>
                <td style="text-align: center; padding: 20px;">
                    @if($check_list->funciona=="Si")
                    <label>Si <input type="radio" class="form-check-input"  style="width: 18px; height: 18px; " checked></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label>No <input type="radio" class="form-check-input"  style="width: 18px; height: 18px; " ></label>
                    @else
                    <label>Si <input type="radio" class="form-check-input"  style="width: 18px; height: 18px; " ></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label>No <input type="radio" class="form-check-input"  style="width: 18px; height: 18px; " checked></label>
                    @endif
                    
                </td>
                <td style="padding: 25px; overflow-wrap: anywhere;">
                    @if($check_list->observaciones!=null)
                    ¿Por que?<br><br>
                    {{$check_list->observaciones}}
                    @endif
                </td>
                
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>





</header>


</body>

</html>



