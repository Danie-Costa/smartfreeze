@extends('layouts.app')

@section('content')

<div class="mt-3 pt-3 container">
    @include('partials.searchbar',['title'=>'Planos','route'=>'plans'])
    <div class="row">
        <div class="col-12 col-sm-1 text-center hide-mobile">#</div>
        <div class="col-6 col-sm-5 text-center"><p>Planos</p></div>
        <div class="col-12 col-sm-2 text-center hide-mobile"><p>Preço</p></div>
        <div class="col-6 col-sm-4 text-center"></div>
        <div class="col-12 col-sm-12 p-0"><hr class="p-0 m-1"></div>
        @foreach($plans as $plan)

            <div class="col-12 col-sm-1 text-center  hide-mobile">{{$loop->index}}</div>
            <div class="col-6 col-sm-5 text-center">{{ $plan->title }}</div>
            <div class="col-12 col-sm-2 text-center  hide-mobile">R$: {{ $plan->price }}</div>
            <div class="col-6 col-sm-4 d-flex justify-content-center">
                {{ Form::open(['route' => ['admin.plans.destroy', $plan->id], 'class' => 'confirmDelete']) }}
                <div class="btn-group btn-group-sm ">
                     @include('partials.crude-menu', ['route' => 'plans','data'=>$plan])
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
