@extends('layouts.app')

@section('title')
    List of Items
@endsection

@section('content')

    <h3>List of Items

    </h3>

    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Items</li>
        <li class="active">List of Items</li>
    </ol>

    @include('messages')

    @if ($items->count())

        <div class="table-responsive">

            <table class="table table-striped table-hover table-condensed">
                <thead>
                <tr>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Category
                    <th>Account</th>
                    <th>Physical?</th>
                    <th>Price Excl.</th>
                    <th>Price Incl.</th>
                    <th>Avg Cost</th>
                    <th>Last Cost</th>
                    <th>Qty on Hand</th>
                    <th>Active</th>
                </tr>
                </thead>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->Code }}</td>
                        <td>{{ $item->Description }}</td>
                        <td>{{ is_object($item->category) ? $item->category->Description : "" }}</td>
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

        {!! str_replace('/?', '?', $items->render()) !!}<br>

    @endif

@endsection
