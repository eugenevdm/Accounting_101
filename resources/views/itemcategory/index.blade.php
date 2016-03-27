@extends('layouts.app')

@section('title')
    Item Categories
@endsection

@section('content')

    <h3>Item Categories

    </h3>

    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Items</li>
        <li class="active">Item Categories</li>
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
                @foreach ($categories as $item)
                    <tr>
                        <td>{{ $item->Description }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        {{--{!! str_replace('/?', '?', $categories->render()) !!}<br>--}}

    @endif

@endsection
