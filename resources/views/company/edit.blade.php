@extends('layouts.app')

@section('title')
    Edit '{{ $c->Name }}'
@endsection

@section('content')

    <h3>Edit '{{ $c->Name }}'
    </h3>

    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('company') }} ">Company</a></li>
        <li class="active">Edit</li>
    </ol>

    @include('messages')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">

    {!! Form::model($c, ['method' => 'PATCH', 'route' => ['company.update', $c->id ]]) !!}
    @include('company/partials/_form', ['submit_text' => 'Update'])
    {!! Form::close() !!}

    </div>
    </div>

@endsection