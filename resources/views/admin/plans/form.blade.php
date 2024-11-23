<div class="row mt-2 ">
    <div class="col-12 col-sm-8">
        {{ Form::label('title', 'Titulo', ['class' => 'required']) }}
        {{ Form::text('title', $data->title, [
            'id' => "",
            'placeholder' => 'Titulo',
            'class' => "form-control",
            'required' => true,
            'disabled'=>$disabled ?? false,
        ]) }}
    </div>

    <div class="col-6 col-sm-2">
        {{ Form::label('order_view', 'Ordem', ['class' => 'required']) }}
        {{ Form::number('order_view', $data->order_view, [
            'id' => "order_view",
            'placeholder' => 'Ordem',
            'class' => "form-control",
            'required' => true,
            'min'=>'0',
            'max'=>'10000',
            'step'=>"1",
            'disabled'=>$disabled ?? false,
        ]) }}
    </div>
    <div class="col-6 col-sm-2">
        {{ Form::label('catalog_limit', 'Limite catalogo', ['class' => 'required']) }}
        {{ Form::number('catalog_limit', $data->catalog_limit, [
            'id' => "catalog_limit",
            'placeholder' => 'Limite catalogo',
            'class' => "form-control",
            'required' => true,
            'min'=>'0',
            'max'=>'10000',
            'step'=>"1",
            'disabled'=>$disabled ?? false,
        ]) }}
    </div>
    <div class="col-6 col-sm-3">
        {{ Form::label('price', 'Preço', ['class' => 'required']) }}
        {{ Form::number('price', $data->price, [
            'id' => "price",
            'placeholder' => 'Preço',
            'class' => "form-control",
            'required' => true,
            'min'=>'0.00',
            'max'=>'10000.00',
            'step'=>"0.01",
            'disabled'=>$disabled ?? false,
        ]) }}
    </div>
    <div class="col-6 col-sm-3">
        {{ Form::label('user_limit','Limite de usuários', ['class' => 'required']) }}
        {{ Form::number('user_limit', $data->user_limit, [
            'id' => "user_limit",
            'placeholder' =>'Limite de usuários',
            'class' => "form-control",
            'required' => true,
            'min'=>'0',
            'step'=>"1",
            'disabled'=>$disabled ?? false,
        ]) }}
    </div>
    <div class="col-6 col-sm-3">
        {{ Form::label('amount', __('Quantidade'), ['class' => 'required']) }}
        {{ Form::number('amount', $data->amount, [
            'id' => "amount",
            'placeholder' => __('Quantidade'),
            'class' => "form-control",
            'required' => true,
            'min'=>'1',
            'step'=>"1",
            'disabled'=>$disabled ?? false, 
        ]) }}
    </div>
    <div class="col-6 col-md-3">
        {{ Form::label('type', 'Periodo', ['class' => '']) }}
        {{ Form::select('type',  $data::TYPE,    $data->type , ['class' => 'form-control','disabled'=>$disabled ?? false,])}}
    </div>
</div>
