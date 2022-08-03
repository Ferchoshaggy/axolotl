@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content_header')
@stop

@section('content')
<div class="card-body">
    <div style="text-align : center">
            <img src="{{ asset('/logos/index.png') }}" width="40%" height="40%">
    </div>
    <div style="display:flex; justify-content:center; margin:0 25% 0 25%;" >
        <button class="btn form-control" style="margin:0 3% 0 0; background:rgb(235, 75, 235); color:white;">Nuevo Proyecto</button>
        <select name="" id="" class="form-control" style="margin:0 0 0 3%;">
            <option value="" style="text-align: center">Seleccione Proyecto</option>
        </select>
                            
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop