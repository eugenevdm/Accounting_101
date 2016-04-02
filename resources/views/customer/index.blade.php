@extends('layouts.app')

@section('title')
    List of Customers
@endsection

@section('content')

    <h3>List of Customers

    </h3>

    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Customers</li>
        <li class="active">List of Customers</li>
    </ol>

    @include('messages')

    @if ($customers->count())

        <div class="table-responsive">

            <table class="table table-striped table-hover table-condensed">
                <thead>
                <tr>
                    {{--<th>ID</th>--}}
                    <th>Name</th>
                    <th>Category</th>
                    <th>Contact Name</th>
                    <th>Telephone</th>
                    <th>Email</th>
                    <th>Sales Rep</th>
                    <th>Active</th>
                    <th>Modified</th>
                </tr>
                </thead>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->Name}}</td>
                        <td>{{ is_object($customer->category) ? $customer->category['Description'] : '' }}</td>
                        <td>{{ $customer->ContactName }}</td>
                        <td>{{ $customer->Telephone }}</td>
                        <td>{{ $customer->Email }}</td>
                        <td>{{ $customer->SalesRepresentativeId }}</td>
                        <td>{{ $customer->Active }}</td>
                        <td>{{ $customer->Modified }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        {!! str_replace('/?', '?', $customers->render()) !!}<br>

    @endif

@endsection
