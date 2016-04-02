@extends('layouts.app')

@section('title')
    Customer Balances - Days Outstanding Report
@endsection

@section('content')

    <h3>Customer Balances - Days Outstanding Report

    </h3>

    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Customers</li>
        <li>Reports</li>
        <li class="active">Customer Balances - Days Outstanding Report</li>
    </ol>

    @include('messages')

    @if ($customerageing->count())

        <div class="table-responsive">

            {{ $customerageing->count() }} total records.
            <table class="table table-condensed table-hover table-striped">
                <thead>
                <tr>
                    <th>Customer</th>
                    <th>120+ Days</th>
                    <th>90 Days</th>
                    <th>60 Days</th>
                    <th>30 Days</th>
                    <th>Current</th>
                    <th>Total Due</th>
                </tr>
                </thead>
                <?php $days_120 = 0; ?>
                <?php $days_90 = 0; ?>
                <?php $days_60 = 0; ?>
                <?php $days_30 = 0; ?>
                <?php $days_current = 0; ?>
                <?php $total = 0; ?>
                @foreach ($customerageing as $item)
                    <tr>
                        <td>{{ $item->customer->Name }}</td>

                        <td>{{ $item->Days120Plus }}</td>
                        <td>{{ $item->Days90 }}</td>
                        <td>{{ $item->Days60 }}</td>
                        <td>{{ $item->Days30 }}</td>
                        <td>{{ $item->Current }}</td>
                        <td>{{ $item->Total }}</td>

                    </tr>

                    <?php $days_120 += $item->Days120Plus ?>
                    <?php $days_90 += $item->Days90 ?>
                    <?php $days_60 += $item->Days60 ?>
                    <?php $days_30 += $item->Days30 ?>
                    <?php $days_current += $item->Current ?>
                    <?php $total += $item->Total ?>

                @endforeach
                <tr>
                    <th>Grand Total</th>
                    <th>{{ $days_120 }}</th>
                    <th>{{ $days_90 }}</th>
                    <th>{{ $days_60 }}</th>
                    <th>{{ $days_30 }}</th>
                    <th>{{ $days_current }}</th>
                    <th>{{ $total }}</th>
                </tr>
            </table>
        </div>

    @endif

@endsection
