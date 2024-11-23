@extends('layouts.app')

@section('content')
<div class="mt-3 pt-3 container">
    @include('partials.searchbar',['title'=>'Empresas','route'=>'companies'])

    <div class="row">
        <div class="col-12 col-sm-1 text-center hide-mobile">#</div>
        <div class="col-6 col-sm-7 text-center"><p>Empresa</p></div>
        <div class="col-6 col-sm-4 text-center"></div>
        <div class="col-12 col-sm-12 p-0"><hr class="p-0 m-1"></div>
        @foreach($companies as $company)
            <div class="col-12 col-sm-1 text-center  hide-mobile">{{$loop->index}}</div>
            <div class="col-6 col-sm-7 text-center">{{ $company->name }}</div>
            <div class="col-6 col-sm-4 d-flex justify-content-center">
                {{ Form::open(['route' => ['admin.companies.destroy', $company->id], 'class' => 'confirmDelete']) }}
                <div class="btn-group btn-group-sm ">
                     @include('partials.crude-menu', ['route' => 'companies','data'=>$company])
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
<script>

</script>
@endsection
