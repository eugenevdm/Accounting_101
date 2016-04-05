@extends('layouts.app')

@section('title')
    Open and Manage Companies
@endsection

@section('content')

    <h3>Open and Manage Companies

    </h3>

    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Company</li>
        <li class="active">Open and Manage Companies</li>
    </ol>

    @include('messages')

    @if ($companies->count())

        <div class="table-responsive">

            <table class="table table-striped table-hover table-condensed">
                <thead>
                <tr>
                    <th></th>
                    <th>Company Name</th>
                    <th>Short Name</th>
                    <th>Username</th>
                    <th>Sync</th>
                    <th>Action</th>
                </tr>
                </thead>
                @foreach ($companies as $company)
                    <tr>
                        <td><a href="{{ route('selectCompany', ['id' => $company->id]) }}">Select</a></td>
                        <td><a href="{{ route('company.show', ['id' => $company->id]) }}">{{ $company->Name}}</a></td>
                        <td>{{ $company->shortname }} </td>
                        <td>{{ $company->username }} </td>
                        <td>{{ $company->sync }} </td>
                        <td width="1%">
                            <a href="{{ route('company.edit',$company->id) }}">
                                    <span class="btn btn-primary btn-sm" title="Edit">
                                    <span class="fa fa-edit "></span></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        {{--{!! str_replace('/?', '?', $companies->render()) !!}<br>--}}

    @endif

@endsection
