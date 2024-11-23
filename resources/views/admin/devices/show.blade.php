@extends('layouts.app')

@section('content')
<div  class="mt-3 pt-3 container container-custom">
    <div class="card-box">
        <div class="row">
            <div class="col-4">
                <img src="{{ asset('storage/'.$data->cover.'') }}" id="img-capa " alt="{{ $data->title }}"  title="{{ $data->title }}" class="mh-200 img-fluid @if($data->cover == '') d-none @endif " >
            </div>
            
            <div class="col-8 info">
                <p class="status text-right">{{ $data->status }} <span class="{{ $data->status }}"></span></p>
                <h2 class="title text-right">{{ $data->title }}</h2>
                <p class="text-right">{{ $data->description }}</p>
            </div>
        </div>
    </div>
    <div class="pt-3 p-2">
        <h2>Atividades recentes</h2>
        <div class="row ">
            <div class="col-12">
                <div class="row lista-atividades">
                    <div class="col-10">
                        <h2>Ativo desde:</h2>
                        <p>Ligado 09:32 às 22:47 em 21/11/2024.</p>
                    </div>
                    
                    <div class="col-2 atividades">
                        <span class="{{ $data->status }}"></span>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- @include('admin.'.$route.'.form',['data'=>$data , 'disabled' =>true]) --}}
</div>
@endsection
@section('css')
<style>
    .container-custom{
        max-width: 550px;
    }
    .lista-atividades {
        padding: 10px 0;
        background: #f9f9f9;
        border-radius: 5px;
    }
    .lista-atividades h2{
        font-size: 16px;
        font-weight: 600;
        color: #414141;
        margin: 0;
    }
    .lista-atividades p{
        margin: 0;
        color: #555;
        font-size: 14px;
    }
    .atividades {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .atividades span{
        padding: 2px 2px;
        background: #ffffff;  
        border-radius: 50%;
        display: inline-block;
    }
    .atividades span.online{
        border: solid 5px #34E0A1;
    }
    .atividades span.offline{
        border: solid 5px #FF4C4C;
    }

    .card-box .info{
        display: flex;
        justify-content: center;
        align-items: end;
        flex-direction: column
    }
    .text-right{
        text-align: right;
    }
    .card-box {
        background: #ffffff;
        padding: 15px;
        border-radius: 10px;
    }
    .card-box p.status{
        text-transform: capitalize;
        position: relative;
        padding: 0 18px 0 0;
        font-weight: 600;
        color: #6d6d6d;
    }
    .card-box p.status span{
        padding: 2px 2px;
        background: #ffffff;

        border-radius: 50%;
        display: inline-block;
        position: absolute;
        top: 5px;
        right: 0px;
    }


    .card-box p.status span.online{
        border: solid 5px #34E0A1;
    }
    .card-box p.status span.offline{
        border: solid 5px #FF4C4C;
    }
    .card-box h2.title{
        padding: 0;
        margin: 0;
        font-size: 16px;
        font-weight: 600;
    }
    .card-box p{
        padding: 0;
        margin: 0;
    }


</style>
@endsection
