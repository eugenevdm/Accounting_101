<div class="form-group">

    {!! Form::label('Sync', 'Synchronise Data', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">

        {!! Form::hidden('sync',0) !!}
        {!! Form::checkbox('sync') !!}

    </div>
</div>

<div class="col-md-6 col-md-offset-4">

    {!! Form::submit($submit_text, ['class' => 'btn btn-default']) !!}

</div>
