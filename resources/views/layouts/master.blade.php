<!DOCTYPE html>
<html>
<head>
    <title>Klecks Werbeverwaltung - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <script src="{{ asset('js/vendor/modernizr.js') }}"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" type="text/css">
</head>
<body>
<nav class="top-bar" data-topbar role="navigation">
    <ul class="title-area">
        <li class="name">
            <h1><a href="{{ route('issues.latest') }}">Klecks Werbeverwaltung</a></h1>
        </li>
        <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
    </ul>

    <section class="top-bar-section">
        {{--
        <!-- Right Nav Section -->
        <ul class="right">
            <li class="active"><a href="#">Right Button Active</a></li>
            <li class="has-dropdown">
                <a href="#">Right Button Dropdown</a>
                <ul class="dropdown">
                    <li><a href="#">First link in dropdown</a></li>
                    <li class="active"><a href="#">Active link in dropdown</a></li>
                </ul>
            </li>
        </ul>
        --}}

        <!-- Left Nav Section -->
        <ul class="left">
            <li><a href="{{ route('issues.index') }}">Ausgaben</a></li>
            <li><a href="{{ route('customers.index') }}">Kunden</a></li>
        </ul>
    </section>
</nav>
<div class="container row">
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
        <div data-alert class="alert-box alert">
            {{ $error }}
            <a href="#" class="close">&times;</a>
        </div>
        @endforeach
    @endif
    @yield('content')
</div>
<script src="{{ asset('js/vendor/foundation.js') }}"></script>
<script src="{{ asset('js/vendor/datatables.js') }}"></script>
<script>
    // initialize Foundation
    $(document).foundation();

    // set some default options for DataTables
    $.extend($.fn.dataTable.defaults, {
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.9/i18n/German.json'
        }
    });
</script>
@yield('end')
</body>
</html>
