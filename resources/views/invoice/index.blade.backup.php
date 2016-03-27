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

    @if ($invoices->count())

        <div class="table-responsive">

            <table class="table table-striped table-hover table-condensed">
                <thead>
                <tr>
                    <th>Company Name</th>

                    <th>Item code</th>
                    <th>Item type</th>
                    <th>Item description</th>
                    <th>Item tax %</th>
                    <th>Item discount %</th>
                    <th>Item price (excl).</th>
                    <th>Item price (incl)</th>
                    <th>Item cost</th>
                    <th>Item quantity</th>
                    <th>Item total discount</th>
                    <th>Item total (excl)</th>
                    <th>Item total tax</th>
                    <th>Item total</th>
                    <th>Item price (incl)</th>

                    <th>Invoice date</th>
                    <th>Invoice no</th>
                    <th>Invoice ref</th>
                    <th>Invoice discount %</th>
                    <th>Invoice tax ref</th>
                    <th>Invoice rounding</th>
                    <th>Invoice amount due</th>
                    <th>Invoice due date</th>

                    <th>Customer code</th>
                    <th>Customer name</th>
                    <th>Customer category</th>
                    <th>Customer tax ref</th>
                    <th>Customer credit limit</th>
                    <th>Customer balance</th>
                    <th>Customer tel</th>
                    <th>Customer fax</th>
                    <th>Customer mobile</th>
                    <th>Customer email</th>
                    <th>Customer web address</th>

                    <th>Sales rep Id</th>
                    <th>Sales rep name</th>
                    <th>Sales rep commission type</th>

                    <th>Analysis Code One</th>
                    <th>Analysis Code Two</th>
                    <th>Analysis Category Two</th>
                    <th>Analysis Code Three</th>
                    <th>Analysis Category Three</th>

                    <th>Column1</th>
                    <th>Column2</th>

                </tr>
                </thead>
                @foreach ($invoices as $item)
                    <tr>
                        <td>{{ $item->customer->Name }}</td>
                        <td>{{ $item->lineitems }}</td>
                        <td>{{ $item->category }}</td>
                        <td>{{ $item->ItemReportingGroupSalesName }}</td>
                        <td>{{ $item->Physical==false ? "" : "Yes" }}</td>
                        <td>{{ $item->PriceExclusive }}</td>
                        <td>{{ $item->PriceInclusive }}</td>
                        <td>{{ $item->AverageCost }}</td>
                        <td>{{ $item->LastCost }}
                        <td>{{ $item->QuantityOnHand }}</td>
                        <td>{{ $item->Active }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        {{--{!! str_replace('/?', '?', $invoices->render()) !!}<br>--}}

    @endif

@endsection
