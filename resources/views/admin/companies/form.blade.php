<div class="row mt-2 ">
    <div class="col-12 col-md-4">
        <img src="{{ asset('storage/'.$data->logo.'') }}" id="img-capa" alt="{{ $data->title }}"  title="{{ $data->title }}" class="img-fluid @if($data->logo == '') d-none @endif " >
        {{ Form::label('image', 'Logo', ['class' => ' ']) }}
        {{Form::file("image",['class' => "form-control" ,"onchange"=>"loadFile(event)",'id'=>'capa','accept'=>'image/png, image/jpeg'])}}
    </div>
    <div class="col-12 col-md-8">
        <div class="row">

            <div class="col-12 col-md-9">
                <div class="form-group">

                    {{ Form::label('email', 'Email*', ['class' => 'required']) }}
                    {{ Form::text('email', $data->corporate_email, [
                        'required' => true,
                        'id' => "email",
                        'placeholder' => 'Email',
                        'class' => "form-control",
                       'required' => true,
                       'disabled'=>$disabled ?? false, 
                    ]) }}
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    {{ Form::label('password', 'Senha', ['class' => 'required']) }}
                    {{ Form::password('password', [
                        'id' => "password",
                        'placeholder' => '********',
                        'class' => "form-control password",
                        'disabled'=>$disabled ?? false, 
                    ]) }}
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="form-group">
                    {{ Form::label('name', 'Nome fantasia*', ['class' => 'required']) }}
                    {{ Form::text('name', $data->name, [
                        'id' => "name",
                        'placeholder' => 'Nome fantasia',
                        'class' => "form-control",
                       'required' => true,
                       'disabled'=>$disabled ?? false, 
                    ]) }}
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="form-group">
                    {{ Form::label('corporate_name', 'Razão social', ['class' => 'requireds']) }}
                    {{ Form::text('corporate_name',  $data->corporate_name, [
                        'id' => "corporate_name",
                        'placeholder' => 'Razão social',
                        'class' => "form-control",
                        'disabled'=>$disabled ?? false, 
                    ]) }}
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    {{ Form::label('cnpj', 'CNPJ', ['class' => 'requireds']) }}
                    {{ Form::text('cnpj',  $data->cnpj, [
                        'id' => "cnpj",
                        'placeholder' => 'CNPJ',
                        'class' => "form-control",
                        'disabled'=>$disabled ?? false, 
                    ]) }}
                </div>
            </div>
            <div class="col-sm-12 col-md-3">
                <div class="form-group">
                    {{ Form::label('plan_id', 'Plano*', ['class' => 'required']) }}
                    {{ Form::select('plan_id', $planList, $data->plan_id, ['class' => 'form-control','required' => true, 'disabled'=>$disabled ?? false, ])}}
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    {{ Form::label('status', 'Status*', ['class' => '']) }}
                    {{ Form::select('status',  $data::STATUS,  $data->status , ['class' => 'form-control','required' => true, 'disabled'=>$disabled ?? false, ])}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-2">
        <div class="form-group">
            {{ Form::label('cep', 'CEP', ['class' => 'requireds']) }}
            {{ Form::text('cep',  $data->cep, [
                'id' => "cep",
                'placeholder' => 'CEP',
                'class' => "form-control",
                'disabled'=>$disabled ?? false, 
            ]) }}
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group">
            {{ Form::label('state_id', 'Estado*', ['class' => '']) }}
            {{ Form::select('state_id',  $states,  $data->state_id , ['class' => 'form-control','id'=>'estado-select','required' => true, 'disabled'=>$disabled ?? false, ])}}
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group">
            {{ Form::label('city_id', 'Cidade*', ['class' => '']) }}
            {{ Form::select('city_id', $cities,  $data->city_id , ['class' => 'form-control','id'=>'city_id','required' => true, 'disabled'=>$disabled ?? false, ])}}
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="form-group">
            {{ Form::label('neighborhood', 'Bairro', ['class' => 'requireds']) }}
            {{ Form::text('neighborhood', $data->neighborhood, [
                'id' => "neighborhood",
                'placeholder' => 'Bairro',
                'class' => "form-control",
                'required' => false,
                'disabled'=>$disabled ?? false, 
            ]) }}
        </div>
    </div>
    <div class="col-12 col-md-10">
        <div class="form-group">
            {{ Form::label('address', 'Rua', ['class' => 'requireds']) }}
            {{ Form::text('address', $data->address, [
                'id' => "address",
                'placeholder' => 'Rua',
                'class' => "form-control",
                'required' => false,
                'disabled'=>$disabled ?? false, 
            ]) }}
        </div>
    </div>
    <div class="col-12 col-md-2">
        <div class="form-group">
            {{ Form::label('number', 'Numero', ['class' => 'requireds']) }}
            {{ Form::text('number', $data->number, [
                'id' => "number",
                'placeholder' => 'Numero',
                'class' => "form-control",
                'required' => false,
                'disabled'=>$disabled ?? false, 
            ]) }}
        </div>
    </div>
    <div class="col-12 col-md-12">
        <div class="form-group">
            {{ Form::label('complement', 'Complemento', ['class' => 'requireds']) }}
            {{ Form::text('complement', $data->complement, [
                'id' => "complement",
                'placeholder' => 'Complemento',
                'class' => "form-control",
                'required' => false,
                'disabled'=>$disabled ?? false, 
            ]) }}
        </div>
    </div>

</div>
@section('incjs')
<script>
    var loadFile = function(event){
        var output = document.getElementById('img-capa');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function(){  URL.revokeObjectURL(output.src) }
        $('#img-capa').removeClass('d-none');
    };
</script>
<script>
    document.getElementById('estado-select').addEventListener('change', function() {
        var estadoId = this.value;
        var url = "{{route('admin.busca-cidades',[123])}}";
        url = url.replace('/123', '/'+estadoId)
        fetch(url)
            .then(response => response.json())
            .then(data => {
                var cidadeSelect = document.getElementById('city_id');
                cidadeSelect.innerHTML = '<option value="">Selecione uma Cidade</option>';
                data.forEach(cidade => {
                    var option = new Option(cidade.title, cidade.id);
                    cidadeSelect.add(option);
                });
            });
    });
    </script>
@endsection