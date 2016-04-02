@extends('layouts.app')

@section('title')
    Bank and Credit Card Categories
@endsection

@section('content')

    <h3>Bank and Credit Card Categories

    </h3>

    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Banking</li>
        <li class="active">Bank and Credit Card Categories</li>
    </ol>

    @include('messages')

    @if ($bankaccountcategories->count())

        <div class="table-responsive">

            <table class="table table-striped table-hover table-condensed">
                <thead>
                <tr>
                    <th>Description</th>
                </tr>
                </thead>
                @foreach ($bankaccountcategories as $bankaccountcategory)
                    <tr>
                        <td>{{ $bankaccountcategory->Description }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        {!! str_replace('/?', '?', $bankaccountcategories->render()) !!}<br>

    @endif

@endsection
