@extends('layouts.app')

@section('content')

<div class="mt-3 pt-3 container">
    @include('partials.searchbar',['title'=>'Usuários notificados','route'=>'recipients'])
    <div class="row">
        <div class="col-12 col-sm-1 text-center hide-mobile">#</div>
        <div class="col-6 col-sm-5 text-center"><p>Nome</p></div>
        <div class="col-12 col-sm-2 text-center hide-mobile"><p>Telefone</p></div>
        <div class="col-6 col-sm-4 text-center"></div>
        <div class="col-12 col-sm-12 p-0"><hr class="p-0 m-1"></div>
        @foreach($recipients as $recipient)

            <div class="col-12 col-sm-1 text-center  hide-mobile">{{$loop->index}}</div>
            <div class="col-6 col-sm-5 text-center">{{ $recipient->name }}</div>
            <div class="col-12 col-sm-2 text-center  hide-mobile">R$: {{ $recipient->phone }}</div>
            <div class="col-6 col-sm-4 d-flex justify-content-center">
                {{ Form::open(['route' => ['admin.recipients.destroy', $recipient->id], 'class' => 'confirmDelete']) }}
                <div class="btn-group btn-group-sm ">
                     @include('partials.crude-menu', ['route' => 'recipients','data'=>$recipient])
                </div>
                 {{ Form::close() }}
            </div>
            <div class="col-12 col-sm-12 p-0"><hr class="p-0 m-1"></div>
        @endforeach
    </div>
</div>
@endsection
@section('js')
@yield('Swal')

@endsection
