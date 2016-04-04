<div class="form-group">
    {!! Form::label('Sync', 'Synchronise Data', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::hidden('sync',0) !!}
        {!! Form::checkbox('sync', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('shortname', 'Short Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('shortname', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="col-md-6 col-md-offset-4">

    {!! Form::submit($submit_text, ['class' => 'btn btn-default']) !!}

</div>
