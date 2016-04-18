<div class="row">

    <div class="form-group">
        {!! Form::label('command', 'Command') !!}
        {!! Form::text('command', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('url', 'URL') !!}
        {!! Form::text('url', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('description', 'Description') !!}
        {!! Form::text('description', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('model', 'Model') !!}
        {!! Form::text('model', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('cron_order', 'CRON Order') !!}
        {!! Form::text('cron_order', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::hidden('cron_include',0) !!}
        {!! Form::checkbox('cron_include') !!}
        {!! Form::label('cron_include', 'CRON Include') !!}
    </div>

    <div class="form-group">

        {!! Form::submit($submit_text, ['class' => 'btn btn-default']) !!}

    </div>

</div>

