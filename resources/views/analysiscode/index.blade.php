@extends('layouts.app')

@section('title')
    Analysis Codes
@endsection

@section('content')

    <h3>Analysis Codes

    </h3>

    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Company</li>
        <li class="active">Analysis Codes</li>
    </ol>

    @include('messages')

    @if ($analysiscategories->count())

        <div class="table-responsive">

            <table class="table table-striped table-hover table-condensed">
                <thead>
                <tr>
                    <th>Category</th>
                    <th>Type</th>
                </tr>
                </thead>
                @foreach ($analysiscategories as $category)
                    <tr>

                        <td>{{ $category->Description }}</td>
                        <td>{{ $category->type->Description }}</td>

                    </tr>
                @endforeach
            </table>
        </div>

        {{--{!! str_replace('/?', '?', $analysiscategories->render()) !!}<br>--}}

    @endif

@endsection
