<div class="form-group">


    {!! Form::label('FromDate', 'From Date', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {{ Form::input('date', 'FromDate', null, ['class' => 'form-control', 'placeholder' => 'From Date']) }}
    </div>

</div>

<div class="form-group">

    {!! Form::label('ToDate', 'To Date', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {{ Form::input('date', 'ToDate', null, ['class' => 'form-control', 'placeholder' => 'To Date']) }}
    </div>

</div>

<div class="form-group">

    <div class="col-md-6 col-md-offset-4">

        {{ Form::radio('ShowMovement', true, true, ['id'=>'type-0']) }}
        {{ Form::label('type-0', 'Closing Balances') }}

        {{ Form::radio('ShowMovement', false, false, ['id'=>'type-1']) }}
        {{ Form::label('type-1', 'Movements') }}

    </div>

</div>

<div class="form-group">
    {!! Form::label('Comparative1', 'Compare with', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::hidden('Comparative',0) !!}
        {!! Form::checkbox('Comparative') !!}
        {{ Form::label('Comparative2', 'Last year') }}
    </div>
</div>

<div class="col-md-6 col-md-offset-4">
    {!! Form::submit($submit_text, ['class' => 'btn btn-default']) !!}
</div>