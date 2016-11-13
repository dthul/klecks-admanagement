<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Klecks Werbeverwaltung - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">
</head>
<body>
<div class="top-bar">
	<div class="top-bar-left">
		<ul class="menu">
			<li class="menu-text">
				<a href="{{ route('issues.latest') }}">Klecks Werbeverwaltung</a>
			</li>
			<li><a href="{{ route('issues.index') }}">Ausgaben</a></li>
			<li><a href="{{ route('customers.index') }}">Kunden</a></li>
		</ul>
    </div>
</div>
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
