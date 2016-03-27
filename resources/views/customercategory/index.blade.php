@extends('layouts.app')

@section('title')
    Customer Categories
@endsection

@section('content')

    <h3>Customer Categories

    </h3>

    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Customers</li>
        <li class="active">Customer Categories</li>
    </ol>

    @include('messages')

    @if ($categories->count())

        <div class="table-responsive">

            <table class="table table-striped table-hover table-condensed">
                <thead>
                <tr>
                    <th>Name</th>
                </tr>
                </thead>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->Description }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        {{--{!! str_replace('/?', '?', $categories->render()) !!}<br>--}}

    @endif

@endsection
