@extends('layouts.app')

@section('title')
    Customer Tax Invoices
@endsection

@section('content')

    <h3>Customer Tax Invoices

    </h3>

    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Customers</li>
        <li class="active">Customer Tax Invoices</li>
    </ol>

    @include('messages')

    @if ($invoiceitems->count())

        <div class="table-responsive">

            <table class="table table-striped table-hover table-condensed">
                <thead>
                <tr>
                    <th>Company Name</th>

                    <th>Item code</th>
                    <th>Item type</th>

                    <th>Item description</th>

                    <th>Item price (incl)</th>

                    <th>Invoice date</th>
                    <th>Invoice no</th>

                    <th>Invoice amount due</th>
                    <th>Invoice due date</th>

                    <th>Customer category</th>

                    <th>Customer balance</th>
                    <th>Customer tel</th>

                    <th>Customer mobile</th>
                    <th>Customer email</th>

                    <th>Analysis Code One</th>
                    <th>Analysis Code Two</th>
                    <th>Analysis Code Three</th>

                </tr>
                </thead>
                @foreach ($invoiceitems as $invoiceitem)
                    <tr>

                        <td>{{ $invoiceitem->invoice->CustomerName }}</td>

                        <td>{{ is_object($invoiceitem->item) ? $invoiceitem->item->Code : "" }} </td>

                        <td>{{ $invoiceitem->item->category->Description or "" }} </td>

                        <td>{{ $invoiceitem->Description}}</td>
                        <td>{{ $invoiceitem->Exclusive}}</td>

                        <td>{{ $invoiceitem->invoice->Date }}</td>
                        <td>{{ $invoiceitem->invoice->DocumentNumber }}</td>
                        <td>{{ $invoiceitem->invoice->AmountDue }}</td>
                        <td>{{ $invoiceitem->invoice->DueDate }}</td>

                        <td>{{ $invoiceitem->invoice->customer->category->Description or "" }}</td>

                        <td>{{ $invoiceitem->invoice->customer->Balance or "" }}</td>
                        <td>{{ $invoiceitem->invoice->customer->Telephone or "" }}</td>
                        <td>{{ $invoiceitem->invoice->customer->Mobile or "" }}</td>
                        <td>{{ $invoiceitem->invoice->customer->Email or "" }}</td>

                        <td>{{ is_object($invoiceitem->analysiscategory1) ? $invoiceitem->analysiscategory1->Description : "" }}</td>
                        <td>{{ is_object($invoiceitem->analysiscategory2) ? $invoiceitem->analysiscategory2->Description : "" }}</td>
                        <td>{{ is_object($invoiceitem->analysiscategory3) ? $invoiceitem->analysiscategory3->Description : "" }}</td>

                    </tr>
                @endforeach
            </table>
        </div>

        {{--{!! str_replace('/?', '?', $invoiceitems->render()) !!}<br>--}}

    @endif

@endsection
