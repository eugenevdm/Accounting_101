@extends('layouts.app')

@section('title')
    List of Items
@endsection

@section('content')

    <h3>List of Items

    </h3>

    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Items</li>
        <li class="active">List of Items</li>
    </ol>

    @include('messages')

    <div class="table-responsive">

        <table id="customers-table" class="table table-striped table-hover table-condensed">
            <thead>
            <tr>
                <th>Code</th>
                <th>Description</th>
                <th>Category</th>
                <th>Sales Item Account</th>
                <th>Price Excl.</th>
                <th>Price Incl.</th>
                <th>Avg Cost</th>
                <th>Last Cost</th>
                <th>Qty on Hand</th>
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
                {data: 'Code', name: 'Code'},
                {data: 'Description', name: 'Description'},
                {data: 'category.Description', name: 'category.Description'}
            ]
        });

    });
</script>
@endpush
