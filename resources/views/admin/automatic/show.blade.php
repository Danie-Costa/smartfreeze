@extends('layouts.app')

@section('content')
<div  class="mt-3 pt-3 container">
    @include('admin.'.$route.'.form',['data'=>$data , 'disabled' =>true])
</div>
@endsection
