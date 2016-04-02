@extends('layouts.app')

@section('title')
    List of Banks and Credit Cards
@endsection

@section('content')

    <h3>List of Banks and Credit Cards

    </h3>

    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Banking</li>
        <li class="active">List of Banks and Credit Cards</li>
    </ol>

    @include('messages')

    @if ($bankaccounts->count())

        <div class="table-responsive">

            <table class="table table-striped table-hover table-condensed">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Bank Name</th>
                    <th>Account Number</th>
                    <th>Branch Name</th>
                    <th>Branch Code</th>
                    <th>Balance</th>
                    <th>Active</th>
                    <th>Default</th>
                </tr>
                </thead>
                @foreach ($bankaccounts as $bankaccount)
                    <tr>
                        <td>{{ $bankaccount->Name }}</td>
                        <td>{{ $bankaccount->BankName }}</td>
                        <td>{{ $bankaccount->AccountNumber }}</td>
                        <td>{{ $bankaccount->BranchName }}</td>
                        <td>{{ $bankaccount->BranchNumber }}</td>
                        <td align="right">{{ $bankaccount->Balance }}</td>
                        <td>{{ $bankaccount->Active }}</td>
                        <td>{{ $bankaccount->Default }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        {!! str_replace('/?', '?', $bankaccounts->render()) !!}<br>

    @endif

@endsection
