@if(Session::has('message'))
    <div class="alert alert-success">
        {{ Session::get('message') }}
    </div>
@endif

@if(Session::has('html_message'))
    <div class="alert alert-success">
        {!! Session::get('html_message') !!}
    </div>
@endif
