@extends('layouts.app')

@section('title')
    Customer Dashboard
@endsection

@section('content')

    <h3>Customer Dashboard

    </h3>

    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="active">Customer Dashboard</li>
    </ol>

    @include('messages')

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Top Customers by Outstanding Balance</div>

                <div class="panel-body">

                    <table class="table table-condensed table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Balance</th>
                        </tr>
                        </thead>

                        @foreach ($outstanding_balance as $client)

                            <tr>
                                <td>{{ $client->Name }}
                                <td>{{ $client->outstanding }}</td>
                            </tr>

                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
