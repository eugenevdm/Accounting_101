@extends('layouts.app')

@section('title')
    List of Sales Reps
@endsection

@section('content')

    <h3>List of Sales Reps

    </h3>

    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Customers</li>
        <li class="active">List of Sales Reps</li>
    </ol>

    @include('messages')

    @if ($salesreps->count())

        <div class="table-responsive">

            <table class="table table-striped table-hover table-condensed">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Mobile</th>
                    <th>Active</th>
                </tr>
                </thead>
                @foreach ($salesreps as $salesrep)
                    <tr>
                        <td>{{ $salesrep->FirstName }}</td>
                        <td>{{ $salesrep->LastName }}</td>
                        <td>{{ $salesrep->Email }}</td>
                        <td>{{ $salesrep->Telephone }}</td>
                        <td>{{ $salesrep->Mobile }}</td>
                        <td>{{ $salesrep->Active }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        {!! str_replace('/?', '?', $salesreps->render()) !!}<br>

    @endif

@endsection
