<div class="row mt-2 ">
    <div class="col-12 col-md-4">
        <img src="{{ asset('storage/'.$data->cover.'') }}" id="img-capa " alt="{{ $data->title }}"  title="{{ $data->title }}" class="mh-200 img-fluid @if($data->cover == '') d-none @endif " >
        {{ Form::label('image', 'Logo', ['class' => ' ']) }}
        {{Form::file("image",['class' => "form-control" ,"onchange"=>"loadFile(event)",'id'=>'capa','accept'=>'image/png, image/jpeg'])}}
    </div>
    <div class="col-12 col-md-8">
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="form-group">
                    {{ Form::label('title', 'Nome do Dispositivo*', ['class' => 'required']) }}
                    {{ Form::text('title', $data->title, [
                        'id' => "title",
                        'placeholder' => 'Nome do dispositivo',
                        'class' => "form-control",
                       'required' => true,
                       'disabled'=>$disabled ?? false, 
                    ]) }}
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="form-group">
                    {{ Form::label('description', 'Descição do dispositivo', ['class' => 'required']) }}
                    {{ Form::text('description',  $data->description, [
                        'id' => "description",
                        'placeholder' => 'Descição do dispositivo',
                        'class' => "form-control",
                        'required' => true,
                        'disabled'=>$disabled ?? false, 
                    ]) }}
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="form-group">
                    {{ Form::label('token', 'Token', ['class' => 'required']) }}
                    {{ Form::text('token',  $data->token, [
                        'id' => "token",
                        'placeholder' => 'Token',
                        'class' => "form-control",
                        'disabled'=>$disabled ?? false, 
                    ]) }}
                </div>
            </div>
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