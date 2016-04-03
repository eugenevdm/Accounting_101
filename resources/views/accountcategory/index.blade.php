@extends('layouts.app')

@section('title')
    Account Categories
@endsection

@section('content')

    <h3>Account Categories

    </h3>

    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Accounts</li>
        <li>Lists</li>
        <li class="active">Account Categories</li>
    </ol>

    @include('messages')

    @if ($accountcategories->count())

        <div class="table-responsive">

            <table class="table table-striped table-hover table-condensed">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Comment</th>
                </tr>
                </thead>
                @foreach ($accountcategories as $accountcategory)
                    <tr>
                        <td>{{ $accountcategory->ID }}</td>
                        <td>{{ $accountcategory->Description }}</td>
                        <td>{{ $accountcategory->Comment }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        {!! str_replace('/?', '?', $accountcategories->render()) !!}<br>

    @endif

@endsection
