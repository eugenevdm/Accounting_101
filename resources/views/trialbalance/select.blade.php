@extends('layouts.app')

@section('title')
    Trial Balance Report
@stop

@section('content')

    <h3>Trial Balance Report</h3>

    <ol class="breadcrumb">

        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Accountant's Area</li>
        <li class="active">Trial Balance Report</li>

    </ol>

    @include('messages')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            {!! Form::open(['action' => 'TrialBalanceController@store','class' => 'form-horizontal']) !!}
            @include('trialbalance/partials/_form', ['submit_text' => 'Confirm Report Options'])
            {!! Form::close() !!}

            @include('errors')

        </div>
    </div>

@endsection