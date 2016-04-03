@extends('layouts.app')

@section('title')
    Account Reporting Groups
@endsection

@section('content')

    <h3>Account Reporting Groups

    </h3>

    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Accounts</li>
        <li class="active">Account Reporting Groups</li>
    </ol>

    @include('messages')

    @if ($reportinggroups->count())

        <div class="table-responsive">

            <table class="table table-striped table-hover table-condensed">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>ParentReportingGroupId</th>
                    <th>Description</th>
                    <th>AccountCategoryId</th>
                </tr>
                </thead>
                @foreach ($reportinggroups as $reportinggroup)
                    <tr>
                        <td>{{ $reportinggroup->ID}}</td>
                        <td>{{ $reportinggroup->ParentReportingGroupId}}</td>
                        <td>{{ $reportinggroup->Description}}</td>
                        <td>{{ $reportinggroup->AccountCategoryId}}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        {!! str_replace('/?', '?', $reportinggroups->render()) !!}<br>

    @endif

@endsection
