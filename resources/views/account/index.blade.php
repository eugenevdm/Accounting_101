@extends('layouts.app')

@section('title')
    List of Accounts
@endsection

@section('content')

    <h3>List of Accounts

    </h3>

    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Accounts</li>
        <li class="active">List of Accounts</li>
    </ol>

    @include('messages')

    @if ($accounts->count())

        <div class="table-responsive">

            <table class="table table-striped table-hover table-condensed">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Active</th>
                    <th>Balance</th>
                    <th>AccountType</th>
                </tr>
                </thead>
                @foreach ($accounts as $account)
                    <tr>
                        <td>{{ $account->Name}}</td>
                        <td>{{ $account->category->Description }}</td>
                        <td>{{ $account->Active}}</td>
                        <td align="right">{{ $account->current_balance }}</td>
                        <td align="center">{{ $account->AccountType }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        {!! str_replace('/?', '?', $accounts->render()) !!}<br>

    @endif

@endsection
