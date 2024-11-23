
    {{ Form::open(['route' => 'admin.orders.store','class' => '', 'files' => true]) }} 
    {{ Form::hidden('card_id', '',['class'=>'hiddenCardId']) }}
    <div class="row">
        <div class="col-12 col-md-2">
            <div class="form-group">
                {{ Form::label('description', 'Descrição', ['class' => 'requireds']) }}
                {{ Form::text('description', '', [
                    'id' => "description",
                    'placeholder' => 'Pedido',
                    'class' => "form-control",
                    'required' => false,
                    'disabled'=>$disabled ?? false, 
                ]) }}
            </div>
        </div>
        <div class="col-6 col-sm-3">
            {{ Form::label('amount', __('Valor do pedido'), ['class' => 'required']) }}
            {{ Form::number('amount', '', [
                'id' => "amount",
                'placeholder' => __('Pontos'),
                'class' => "form-control orderAmount",
                'required' => true,
                'min'=>'1',
                'step'=>"0.01",
                'disabled'=>$disabled ?? false, 
            ]) }}
        </div>
        
        <div class="col-6 col-sm-3">
            {{ Form::label('score', __('Pontos'), ['class' => 'required']) }}
            {{ Form::number('score', '', [
                'id' => "score",
                'placeholder' => __('Pontos'),
                'class' => "form-control orderScore",
                'required' => true,
                'min'=>'1',
                'step'=>"1",
                'disabled'=>true, 
            ]) }}
        </div>
        <div class="col-12 col-sm-12">
            <button type="submit" class="btn btn-success btn-block  ">Pontuar</button>
        </div>
    </div>  
    {{ Form::close() }}    
