<!DOCTYPE html>
<html>
<style type="text/css">
    input[type="radio"]:checked {
        background-color: black;
    }
</style>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Encuesta | AXOLOTL SONFTWARE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>

    @if($datos->estado=="activo")
    @if($datos->contestado=="no")
    <div class="card" style="margin: 3%;">
      <div class="card-body">
        <div  style="background-color: #24252A; display: inline-block; width: 100%;">
                <div style="float: left; position: absolute; background-color: #24252A;">
                    <img src="{{url('formatos/ecabezado1.png')}}" style="  max-width: 100%; height: 120px;" id="img1">
                </div>
                <div style="float: right; background-color: #24252A;">
                    <img src="{{url('formatos/ecabezado2.png')}}"style="max-width: 100%; height: 120px;" id="img2">
                </div>
        </div>
        <label style="width: 100%; text-align: center; font-weight: bold; font-size: 30px; margin: 20px;">Check List</label>

        <form method="POST" action="{{url('/Envio_Cliente')}}">
            @csrf
            <!-- funcional-->
            <div class="col-md-12" style="margin-bottom: 20px;">
                <label style="width: 100%;  font-size: 25px; padding-right: 20px; padding-left: 20px;">Pruebas Funcionales <br><li style="width: 100%; background-color:grey; height: 2px; list-style:none;"></li></label>

                @foreach($check_lists as $check_list)
                @if($check_list->tipo==1)
                <input type="hidden" name="ids[]" id="ids[]" value="{{$check_list->id}}">
                <div class="row" style="margin: 20px;">

                    <div class="col-md-3" style="padding: 10px;">
                        {{$check_list->prueba}}
                    </div>

                    <div class="col-md-3" style="padding: 10px;">
                        {{$check_list->caracteristicas}}
                    </div>

                    <div class="col-md-3" style="padding: 10px;" >

                        <div class="row" style="text-align: center;">
                            <div class="col-md-6">
                                <p>Si <input type="radio" class="form-check-input" name="check{{$check_list->id}}"  style="width: 18px; height: 18px; " value="Si" onclick="detectar_check({{$check_list->id}},1)" onchange="detectar_check({{$check_list->id}},1)"></p>
                            </div>
                            <div class="col-md-6">
                                <p>No <input type="radio" class="form-check-input" name="check{{$check_list->id}}"  style="width: 18px; height: 18px; " value="No" onclick="detectar_check({{$check_list->id}},0)" onchange="detectar_check({{$check_list->id}},0)"></p>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3" style="padding: 10px;">
                        <div id="campo_observaciones{{$check_list->id}}" style="display: none;">
                            <label>¿Por que?</label>
                            <textarea name="observaciones{{$check_list->id}}" placeholder="INDICA QUE ES LO QUE PASA" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                
            </div>


            <!-- no funcional-->
            <div class="col-md-12" style="margin-bottom: 20px;">
                <label style="width: 100%;  font-size: 25px; padding-right: 20px; padding-left: 20px;">Pruebas no Funcionales <br><li style="width: 100%; background-color:grey; height: 2px; list-style:none;"></li></label>

                @foreach($check_lists as $check_list)
                @if($check_list->tipo==2)
                <input type="hidden" name="ids[]" id="ids[]" value="{{$check_list->id}}">
                <div class="row" style="margin: 20px;">

                    <div class="col-md-3" style="padding: 10px;">
                        {{$check_list->prueba}}
                    </div>

                    <div class="col-md-3" style="padding: 10px;">
                        {{$check_list->caracteristicas}}
                    </div>

                    <div class="col-md-3" style="padding: 10px;" >

                        <div class="row" style="text-align: center;">
                            <div class="col-md-6">
                                <p>Si <input type="radio" class="form-check-input" name="check{{$check_list->id}}"  style="width: 18px; height: 18px; " value="Si" onclick="detectar_check({{$check_list->id}},1)" onchange="detectar_check({{$check_list->id}},1)"></p>
                            </div>
                            <div class="col-md-6">
                                <p>No <input type="radio" class="form-check-input" name="check{{$check_list->id}}"  style="width: 18px; height: 18px; " value="No" onclick="detectar_check({{$check_list->id}},0)" onchange="detectar_check({{$check_list->id}},0)"></p>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3" style="padding: 10px;">
                        <div id="campo_observaciones{{$check_list->id}}" style="display: none;">
                            <label>¿Por que?</label>
                            <textarea name="observaciones{{$check_list->id}}" placeholder="INDICA QUE ES LO QUE PASA" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                
            </div>

            <!-- seguridad-->
            <div class="col-md-12" style="margin-bottom: 20px;">
                <label style="width: 100%;  font-size: 25px; padding-right: 20px; padding-left: 20px;">Pruebas de Seguridad <br><li style="width: 100%; background-color:grey; height: 2px; list-style:none;"></li></label>

                @foreach($check_lists as $check_list)
                @if($check_list->tipo==3)
                <input type="hidden" name="ids[]" id="ids[]" value="{{$check_list->id}}">
                <div class="row" style="margin: 20px;">

                    <div class="col-md-3" style="padding: 10px;">
                        {{$check_list->prueba}}
                    </div>

                    <div class="col-md-3" style="padding: 10px;">
                        {{$check_list->caracteristicas}}
                    </div>

                    <div class="col-md-3" style="padding: 10px;" >

                        <div class="row" style="text-align: center;">
                            <div class="col-md-6">
                                <p>Si <input type="radio" class="form-check-input" name="check{{$check_list->id}}"  style="width: 18px; height: 18px; " value="Si" onclick="detectar_check({{$check_list->id}},1)" onchange="detectar_check({{$check_list->id}},1)"></p>
                            </div>
                            <div class="col-md-6">
                                <p>No <input type="radio" class="form-check-input" name="check{{$check_list->id}}"  style="width: 18px; height: 18px; " value="No" onclick="detectar_check({{$check_list->id}},0)" onchange="detectar_check({{$check_list->id}},0)"></p>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3" style="padding: 10px;">
                        <div id="campo_observaciones{{$check_list->id}}" style="display: none;">
                            <label>¿Por que?</label>
                            <textarea name="observaciones{{$check_list->id}}" placeholder="INDICA QUE ES LO QUE PASA" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                
            </div>

            <div class="col-md-12" style="text-align: right; padding: 20px;">
                <button class="btn btn-primary" style="font-size: 20px;">ENVIAR</button>
            </div>
            
        </form>
        

      </div>
    </div>
    @else
    <div class="card-body">
        <div style="text-align : center; ">
            <img src="{{ asset('/logos/animacion.gif') }}" width="30%" height="30%" style="border-radius: 100%;">
        </div>
        <div>
            <h1 style="margin-right: 0px; margin-left: 0px; margin-top: 10px; text-align : center;">GRACIAS POR CONTESTAR, ESPERA EL PROXIMO</h1>
        </div>
    </div>
    @endif
    @else
    <div class="card-body">
        <div style="text-align : center; ">
            <img src="{{ asset('/logos/animacion.gif') }}" width="30%" height="30%" style="border-radius: 100%;">
        </div>
        <div>
            <h1 style="margin-right: 0px; margin-left: 0px; margin-top: 10px; text-align : center;">Upss! se desactivo la encuesta por el momento</h1>
        </div>
    </div>
    @endif
</body>

<script type="text/javascript">
    
    function detectar_check(id,tipo){

        if(tipo==0){
            document.getElementById("campo_observaciones"+id).style.display="block";
        }else{
            document.getElementById("campo_observaciones"+id).style.display="none";
        }
    }

    var windowWidth = window.innerWidth;
    var windowHeight = window.innerHeight;

    window.addEventListener('resize', start);

    valor=document.documentElement.clientWidth;
    console.log(valor);

    function start(){
        if(valor<document.documentElement.clientWidth){
            valor=document.documentElement.clientWidth;
            console.log("+");
            tamanoY=document.getElementById("img1").height;
            tamanoY++;
            document.getElementById("img1").style.height=tamanoY+"px";
            tamanoY2=document.getElementById("img2").height;
            tamanoY2++;
            document.getElementById("img2").style.height=tamanoY2+"px";
        }else{
            valor=document.documentElement.clientWidth;
            console.log("-");
            if(valor>560){
                tamanoY=document.getElementById("img1").height;
                tamanoY--;
                document.getElementById("img1").style.height=tamanoY+"px";
                tamanoY2=document.getElementById("img2").height;
                tamanoY2--;
                document.getElementById("img2").style.height=tamanoY+"px";
            }else if(valor<560){
                document.getElementById("img1").style.height="35px";
                document.getElementById("img2").style.height="35px";
            }else if(valor<300){
                document.getElementById("img1").style.height="30px";
                document.getElementById("img2").style.height="30px";
            }
            
        }
    }
    if(windowWidth>1000){
        document.getElementById("img1").style.height="200px";
        document.getElementById("img2").style.height="200px";
    }else if(windowWidth<700){
        document.getElementById("img1").style.height="50px";
        document.getElementById("img2").style.height="50px";
    }else if(windowWidth<600){
        document.getElementById("img1").style.height="35px";
        document.getElementById("img2").style.height="35px";
    }else if(windowWidth<300){
        document.getElementById("img1").style.height="30px";
        document.getElementById("img2").style.height="30px";
    }

</script>

</html>
