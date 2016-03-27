<nav class="navbar navbar-default">
    <div class="container">

        <div class="navbar-header" style="height: 56px">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ $company->Name }}<br>
                <font size="1">Accounting 101</font>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">

            @if (!Auth::guest())

            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="{{ url('home') }}">Dashboard</a></li>

                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">Customers <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('customer') }}">List of Customers</a></li>
                            {{--<li><a href="{{ url('salesreps') }}">List of Sales Reps</a></li>--}}
                            <li><a href="{{ url('customercategory') }}">Customer Categories</a></li>
                            <li><a href="{{ url('invoice') }}">Customer Tax Invoices</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">Items <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('item') }}">List of Items</a></li>
                            <li><a href="{{ url('itemcategory') }}">Item Categories</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">Accounts <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('account') }}">List of Accounts</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">Company <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('company') }}">Open and Manage Companies</a></li>
                            <li><a href="{{ url('settings') }}">Change API Settings</a></li>
                            <li><a href="{{ url('analysiscode') }}">Analysis Codes</a></li>
                            <li><a href="{{ url('import/accounts') }}">Import Accounts</a></li>
                            <li><a href="{{ url('import/accountcategories') }}">Import Account Categories</a></li>
                            <li><a href="{{ url('import/analysiscategories') }}">Import Analysis Categories</a></li>
                            <li><a href="{{ url('import/analysistypes') }}">Import Analysis Types</a></li>
                            <li><a href="{{ url('import/companies') }}">Import Companies</a></li>
                            <li><a href="{{ url('import/customers') }}">Import Customers</a></li>
                            <li><a href="{{ url('import/customercategories') }}">Import Customer Categories</a></li>
                            <li><a href="{{ url('import/items') }}">Import Items</a></li>
                            <li><a href="{{ url('import/itemcategories') }}">Import Item Categories</a></li>
                            <li><a href="{{ url('import/taxinvoices') }}">Import Tax Invoices</a></li>
                        </ul>
                    </li>
                </ul>

            </ul>

            @endif

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Login</a></li>
                @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                    </ul>
                </li>
                @endif
            </ul>

            {{--@if (!Auth::guest())--}}

            {{--<form class="navbar-form navbar-right" id="search" role="search">--}}
                {{--<div class="form-group">--}}
                    {{--<input type="text" id="autocomplete_in_nav" class="form-control" placeholder="Search">--}}
                {{--</div>--}}
            {{--</form>--}}

            {{--@endif--}}

        </div>

    </div>

</nav>