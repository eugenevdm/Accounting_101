@extends('layouts.app')

@section('title')
    {{ $c->Name }} Information
@endsection

@section('content')

    <h3>{{ $c->Name }} Information

        <a href="{{ route('company.edit',$c->id) }}"
           style="float:right"
           class="btn btn-primary btn-sm">
            <i class="fa fa-pencil fa-fw"></i> Edit
            {{--<span class="glyphicon glyphicon-plus"></span> Edit Company--}}
        </a>

    </h3>

    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Company</li>
        <li>Open and Manage Companies</li>
        <li class="active">{{ $c->Name }} Information</li>
    </ol>

    @include('messages')

    <div class="row">

        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-heading">Company Summary</div>
                <div class="panel-body">

                    <table class="table table-striped table-hover table-condensed">

                        <tr>
                            <td>Name</td>
                            <th>{{ $c->Name }}</th>
                        </tr>

                    </table>

                </div>
            </div>
        </div>

        <div class="col-md-9">

            <div class="panel panel-default">
                <div class="panel-heading" style="height: 50px">API Commands

                    <a href="{{ route('apicommand.create',$c->id) }}"
                       style="float:right"
                       class="btn btn-primary btn-sm">
                        <i class="fa fa-plus fa-fw"></i> New
                        {{--<span class="glyphicon glyphicon-plus"></span> Edit Company--}}
                    </a>

                </div>
                <div class="panel-body">

                    <div class="table-responsive">

                        <table class="table table-striped table-hover table-condensed">
                            <tr>
                                <th>Command</th>
                                <th>Last Total Results</th>
                                <th>Updated At</th>
                                <th>CRON Order</th>
                                <th>Model</th>
                                <th>CRON Include</th>
                            </tr>
                            @foreach($api_commands as $api_command)
                                <tr>
                                    <td>{{ $api_command->command }}</td>
                                    <td>{{ $api_command->last_total_results }}</td>
                                    <td>@if ($api_command->updated_at) {{ $api_command->updated_at->diffForHumans() }} @endif</td>
                                    <td>{{ $api_command->cron_order }}</td>
                                    <td>{{ $api_command->model }}</td>
                                    <td>{{ $api_command->cron_include }}</td>
                                </tr>
                            @endforeach
                        </table>

                    </div>

                </div>
            </div>
        </div>

    </div>

@stop