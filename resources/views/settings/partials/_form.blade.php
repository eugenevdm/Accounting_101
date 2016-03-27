@foreach($settings as $setting)


<div class="form-group">
    {!! Form::label($setting->name, $setting->description, ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text($setting->name, $setting->value, ['class' => 'form-control']) !!}
    </div>
</div>

@endforeach

<div class="col-md-6 col-md-offset-4">
    {!! Form::submit($submit_text, ['class' => 'btn btn-default']) !!}
</div>