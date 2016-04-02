@foreach($apisettings as $apisetting)


<div class="form-group">
    {!! Form::label($apisetting->name, $apisetting->description, ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text($apisetting->name, $apisetting->value, ['class' => 'form-control']) !!}
    </div>
</div>

@endforeach

<div class="col-md-6 col-md-offset-4">
    {!! Form::submit($submit_text, ['class' => 'btn btn-default']) !!}
</div>