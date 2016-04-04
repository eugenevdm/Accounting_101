@extends('layouts.app')

@section('title')
    Supplier Purchase Orders
@endsection

@section('content')

    <h3>Supplier Purchase Orders

    </h3>

    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Suppliers</li>
        <li>Transactions</li>
        <li class="active">Supplier Purchase Orders</li>
    </ol>

    @include('messages')

    @if ($purchaseorders->count())

        <div class="table-responsive">

            <table class="table table-striped table-hover table-condensed">
                <thead>
                <tr>
                    <th>Supplier Name</th>
                    <th>Doc. No.</th>
                    <th>Order No</th>
                    <th>Date</th>
                    <th>Printed</th>
                </tr>
                </thead>
                @foreach ($purchaseorders as $purchaseorder)
                    <tr>
                        <td>{{ $purchaseorder->SupplierName}}</td>
                        <td>{{ $purchaseorder->DocumentNumber }}</td>
                        <td>{{ $purchaseorder->Reference }}</td>
                        <td>{{ $purchaseorder->Date }}</td>
                        <td>{{ $purchaseorder->Printed }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        {!! str_replace('/?', '?', $purchaseorders->render()) !!}<br>

    @endif

@endsection
