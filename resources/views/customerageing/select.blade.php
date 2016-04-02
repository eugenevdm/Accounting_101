@extends('layouts.app')

@section('title')
    Customer Balances - Days Outstanding Report
@stop

@section('content')

    <h3>Customer Balances - Days Outstanding Report</h3>

    <ol class="breadcrumb">

        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Customers</li>
        <li>Reports</li>
        <li class="active">Customer Balances - Days Outstanding Report</li>

    </ol>

    @include('messages')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            {!! Form::open(['action' => 'CustomerAgeingController@store','class' => 'form-horizontal']) !!}
            @include('customerageing/partials/_form', ['submit_text' => 'Confirm Report Options'])
            {!! Form::close() !!}

            @include('errors')

        </div>
    </div>

@endsection