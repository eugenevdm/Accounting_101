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
        <div class="col-md-4 col-md-offset-4">

            {!! Form::open(['action' => 'ApiCommandController@store','class' => 'form-horizontal']) !!}
            @include('apicommand/partials/_form', ['submit_text' => 'Create'])
            {!! Form::close() !!}

            @include('errors')

        </div>
    </div>

@endsection