@extends('layouts.app')

@section('title')
    Edit '{{ $apicommand->command }}'
@endsection

@section('content')

    <h3>Edit '{{ $apicommand->command }}'</h3>

    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Company</li>
        <li>API</li>
        <li><a href="{{ url('apicommand') }}">API Commands</a></li>
        <li class="active">Edit '{{ $apicommand->command }}'</li>
    </ol>

    {!! Form::model($apicommand, ['method' => 'PATCH', 'route' => ['apicommand.update', $apicommand->id ]]) !!}
    @include('apicommand/partials/_form', ['submit_text' => 'Edit'])
    {!! Form::close() !!}

@endsection