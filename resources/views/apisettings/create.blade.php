@extends('layouts.app')

@section('title')
    Settings
@stop

@section('content')

    <h3>Settings</h3>

    <ol class="breadcrumb">

        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Company</li>
        <li class="active">Settings</li>

    </ol>

    @include('messages')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            {!! Form::open(['action' => 'ApiSettingsController@store','class' => 'form-horizontal']) !!}
            @include('apisettings/partials/_form', ['submit_text' => 'Update API Settings'])
            {!! Form::close() !!}

            @include('errors')

        </div>
    </div>

@endsection