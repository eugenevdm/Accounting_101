@extends('layouts.app')

@section('title')
    API Commands
@endsection

@section('content')

    <h3>API Commands

    </h3>

    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Company</li>
        <li>API</li>
        <li><a href="{{ url('apicommand') }}">API Commands</a></li>
    </ol>

    @include('messages')

    @if ($apicommands->count())

        <div class="table-responsive">

            <table class="table table-striped table-hover table-condensed">
                <thead>
                <tr>
                    <th>Command</th>
                    <th>Description</th>
                    <th>Model</th>
                    <th>CRON Order</th>
                    <th>CRON Include</th>
                </tr>
                </thead>
                @foreach ($apicommands as $apicommand)
                    <tr>
                        <td><a href="{{ route('apicommand.show', $apicommand->id) }}">{{ $apicommand->command }}</a></td>
                        <td>{{ $apicommand->description }}</td>
                        <td>{{ $apicommand->model }}</td>
                        <td>{{ $apicommand->cron_order }}</td>
                        <td>{!! $apicommand->cron_include !!}</td>
                        <td>
                            <a href="{{ route('apicommand.edit',$apicommand->id) }}">
                                    <span class="btn btn-primary btn-sm" title="Edit">
                                    <span class="fa fa-edit "></span></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        {{--{!! str_replace('/?', '?', $apicommands->render()) !!}<br>--}}

    @endif

@endsection
