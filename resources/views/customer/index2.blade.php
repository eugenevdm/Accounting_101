@extends('layouts.app')

@section('title')
    List of Customers
@endsection

@section('content')

    <h3>List of Customers

    </h3>

    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Customers</li>
        <li class="active">List of Customers</li>
    </ol>

    @include('messages')

    <div class="table-responsive">

        <table id="customers-table" class="table table-striped table-hover table-condensed">
            <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                {{--<th>Balance</th>--}}
                <th>Contact Name</th>
                <th>Tel Number</th>
                <th>Mobile No.</th>
                <th>Active</th>
            </tr>
            </thead>
        </table>

    </div>

@stop

@push('scripts')
<script>
    $(function () {
        $('#customers-table').DataTable({
            processing: true,
            serverSide: true,
            iDisplayLength: 100,
            buttons: ['csv', 'excel', 'pdf'],
            //dom: 'Bfrtip',
            //dom: 'frtip',
//            buttons: [
//                'copy', 'excel', 'pdf', 'csvHtml5'
//            ],
            ajax: '{!! route('datatables.data') !!}',
            columns: [
                {data: 'Name', name: 'Name'},
                {data: 'CategoryId', name: 'CategoryId'},
                {data: 'ContactName', name: 'ContactName'},
                {data: 'Telephone', name: 'Telephone'},
                {data: 'Mobile', name: 'Mobile'},
                {data: 'Active', name: 'Active'}
            ]
        });

    });
</script>
@endpush
