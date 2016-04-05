@extends('layouts.app')

@section('title')
    {{ $user->name }}
@stop

@section('content')

    <h3>{{ $user->name }}

        <a href="{{ route('team.edit',$user->id) }}" style="float:right">
            <span class="btn btn-primary btn-sm" title="Edit">
            <span class="fa fa-edit "></span></span>
        </a>

    </h3>

    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Admin</li>
        <li><a href="{{ url('/team') }}">Team</a></li>
        <li class="active">{{ $user->name }}</li>
    </ol>

    @include('messages')

    <div class="row">

        <div class="col-md-6">

            <div class="panel panel-default">
                <div class="panel-heading">Team Member Information</div>
                <div class="panel-body">

                    <table class="table table-striped table-hover table-condensed">

                        <tr>
                            <th>Name</th>
                            <th>{{ $user->name }}</th>
                        </tr>

                        <tr>
                            <td>Role</td>
                            <td>{{ $user->role }}</td>
                        </tr>

                        <tr>
                            <td>Description</td>
                            <td>{!! $user->description !!}</td>
                        </tr>

                    </table>

                </div>
            </div>
        </div>

    </div>



@stop