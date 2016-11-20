<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Klecks Werbeverwaltung') }} - @yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div class="top-bar">
        <div class="top-bar-left">
            <ul class="menu">
                <li class="menu-text">
                    <a href="{{ route('issues.latest') }}">{{ config('app.name', 'Klecks Werbeverwaltung') }}</a>
                </li>
            @if (Auth::guest())
            @else
                <li><a href="{{ route('issues.index') }}">Ausgaben</a></li>
                <li><a href="{{ route('customers.index') }}">Kunden</a></li>
                <li><a href="{{ url('/register') }}">Benutzer</a></li>
                <li>
                    <a href="{{ url('/logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @endif
            </ul>
        </div>
    </div>
    <div class="row">
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
            <div class="small-12 columns">
                <div class="alert callout" data-closable>
                    {{ $error }}
                    <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endforeach
        @endif
    </div>
    @yield('content')

    <!-- Scripts -->
    <script src="{{ asset('js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('js/vendor/what-input.min.js') }}"></script>
    <script src="{{ asset('js/vendor/foundation.js') }}"></script>
    <script src="{{ asset('js/vendor/datatables.js') }}"></script>
    <script>
        // initialize Foundation
        $(document).foundation();

        // set some default options for DataTables
        $.extend($.fn.dataTable.defaults, {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.12/i18n/German.json'
            }
        });
    </script>
    @yield('end')
</body>
</html>
