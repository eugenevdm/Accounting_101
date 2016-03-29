@extends('layouts.app')

@section('title')
    Trial Balance Report
@endsection

@section('content')

    <h3>Trial Balance Report

    </h3>

    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Accountant's Area</li>
        <li>Reports</li>
        <li>Management Reports</li>
        <li class="active">Trial Balance</li>
    </ol>

    @include('messages')

    <h6>
        Date Range: {{$fromDate}} -> {{$toDate}}
    </h6>

    @if ($trialbalance->count())

        <div class="table-responsive">

            <table class="table table-condensed table-hover table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Source</th>
                    <th align="right">Debit</th>
                    <th align="right">Credit</th>
                </tr>
                </thead>
                <?php $debit = 0; ?>
                <?php $credit = 0; ?>
                @foreach ($trialbalance as $item)
                    <tr>
                        <td>{{ $item->Name}}</td>
                        {{--<td>{{ $item->AccountId }}</td>--}}

                        <td>{{ $item->account->category->Description or $item->AccountId }}</td>

                        {{--<td>{{ $item->AccountTypeId }}</td>--}}

                        <td>{{ $item->accounttype->name or $item->AccountTypeId  }}</td>

                        <td nowrap width='1%' align="right">{{ $item->Debit == 0 ? "" : "R " . money_format("%.2n", $item->Debit) }}</td>
                        <td nowrap width='1%' align="right">{{ $item->Credit == 0 ? "" : "R " . money_format("%.2n", $item->Credit) }}</td>
                    </tr>
                    <?php $debit += $item->Debit ?>
                    <?php $credit += $item->Credit ?>

                @endforeach
                <tr>
                    <td nowrap colspan="4" align="right">
                        <strong>R {{ $debit }}</strong>
                    </td>
                    <td nowrap align="right">
                        <strong>R {{ $credit }}</strong>
                    </td>
                </tr>
            </table>
        </div>

    @endif

@endsection
