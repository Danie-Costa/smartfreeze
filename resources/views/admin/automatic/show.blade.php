@extends('layouts.app')

@section('content')
<div  class="mt-3 pt-3 container">
    <a href="{{ url()->previous() }}" class="btn btn-secondary">
        <i class="fa fa-arrow-left"></i> Voltar
    </a>
    @include('admin.'.$route.'.form',['data'=>$data , 'disabled' =>true])
</div>
@endsection
