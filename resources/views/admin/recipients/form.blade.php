<div class="row mt-2 ">
    <div class="col-12 col-sm-8">
        {{ Form::label('name', 'Nome', ['class' => 'required']) }}
        {{ Form::text('name', $data->name, [
            'id' => "",
            'placeholder' => 'Nome',
            'class' => "form-control",
            'required' => true,
            'disabled'=>$disabled ?? false,
        ]) }}
    </div>
    <div class="col-12 col-sm-8">
        {{ Form::label('phone', 'Telefone', ['class' => 'required']) }}
        {{ Form::text('phone', $data->phone, [
            'id' => "phone",
            'placeholder' => '(11) 99999-9999',
            'class' => "form-control",
            'required' => true,
            'disabled'=>$disabled ?? false,
        ]) }}
    </div>

    
</div>
@section('incjs')
    <script>
        $(document).ready(function(){
            $('#phone').mask('(00) 00000-0000');
        });
    </script>
@endsection