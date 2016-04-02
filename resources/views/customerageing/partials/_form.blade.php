<div class="form-group">

    {!! Form::label('ToDate', 'Run at Date', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {{ Form::input('date', 'ToDate', date("Y-m-d"), ['class' => 'form-control', 'placeholder' => 'Todays\'s Date']) }}
    </div>

</div>

<div class="form-group">
    {!! Form::label('Customer', 'Customer', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('FromCustomer', '', ['class' => 'form-control']) !!}
        {!! Form::text('ToCustomer', '', ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('Category', 'Category', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('FromCategory', '', ['class' => 'form-control']) !!}
        {!! Form::text('ToCategory', '', ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">

    <div class="col-md-6 col-md-offset-4">

        {{ Form::radio('status', 'both', true) }}
        &nbsp;&nbsp;Both (Active/Inactive

        {{ Form::radio('status', 'active', false) }}
        &nbsp;&nbsp;Active

        {{ Form::radio('status', 'inactive', false) }}
        &nbsp;&nbsp;Inactive

    </div>

</div>

<div class="form-group">

    <div class="col-md-6 col-md-offset-4">

        {{ Form::radio('Summary', true, true) }}
        &nbsp;&nbsp;Summary

        {{ Form::radio('Summary', false, false) }}
        &nbsp;&nbsp;Detailed

    </div>

</div>

<div class="form-group">
    {!! Form::label('ExcludeZeroBalance', 'Exclude', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::hidden('ExcludeZeroBalance',0) !!}
        {!! Form::checkbox('ExcludeZeroBalance') !!}
        &nbsp;&nbsp;Customers with Zero Balances
    </div>
</div>

<div class="col-md-6 col-md-offset-4">
    {!! Form::submit($submit_text, ['class' => 'btn btn-default']) !!}
</div>