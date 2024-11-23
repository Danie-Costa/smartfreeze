@extends('layouts.app')

@section('content')

<div class="mt-3 pt-3 container">
    @include('partials.searchbar',['title'=>'Meus Dispositivos','route'=>'devices'])
    <div class="row">
        @foreach($devices as $device)
        <div class="col-6 col-sm-2">
            @if(GetMyRule() != 'admin')
                <a href="{{route('admin.devices.show', $device->id)}}" title="{{ $device->title }}">
            @endif
                <div class="card-device {{ $device->status }}">
                    <img src="{{ asset('storage/'.$device->cover.'') }}" alt="{{ $device->title }}"  title="{{ $device->title }}" class="img-fluid" >
                    <h2 class="title">{{ $device->title }}</h2>
                    <p>{{ $device->description }}</p>
                    @if(GetMyRule() == 'admin')
                        <div class="crud-menu">
                            {{ Form::open(['route' => ['admin.devices.destroy', $device->id], 'class' => 'confirmDelete']) }}
                            <div class="btn-group btn-group-sm ">
                                @include('partials.crude-menu', ['route' => 'devices','data'=>$device])
                            </div>
                            {{ Form::close() }}
                        </div>
                    @endif

                </div>
            @if(GetMyRule() != 'admin')
                </a>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection
@section('js')
@yield('Swal')

@endsection
