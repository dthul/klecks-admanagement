@extends('layouts.master')

@section('title', 'Ausgabe '.$issue->name)

@section('content')
    <h1>Ausgabe {{ $issue->name }} @include('components.issue', ['issue' => $issue, 'linkText' => '', 'linkHtml' => '<i class="fa fa-pencil"></i>'])</h1>
    <p>Fällig am {{ $issue->due->formatLocalized('%A, %d. %B %Y') }}</p>
    <h2>Werbeformate</h2>
    <table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Preis</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach($issue->adformats as $adformat)
        <tr>
            <td>{{ $adformat->name }}</td>
            <td>{{ $adformat->price / 100 }} €</td>
            <td>@include('components.adformat', ['adformat' => $adformat, 'linkText' => '', 'linkHtml' => '<i class="fa fa-pencil"></i>'])</td>
            <td><form method="POST" action="{{ route('adformats.delete', $adformat->id) }}">{!! csrf_field() !!}<a href="#" onclick="$(this).closest('form').submit()"><i class="fa fa-trash-o"></i></a></form></td>
        </tr>
    @endforeach
    <tr>
        <td colspan="4">@include('components.adformat', ['adformat' => null, 'issue' => $issue])</td>
    </tr>
    </tbody>
    </table>
    <h2>Anzeigen <span class="label">{{ $issue->advertisements()->count() }}</h2>
    <p>@include('components.advertisement', ['advertisement' => null, 'issue' => $issue, 'customers' => $customers])</p>
    <table id="advertisements_table">
    <thead>
        <tr>
            <th>Kunde</th>
            <th>Werbeformat</th>
            <th>Preis</th>
            <th data-searchable="false">Bezahlt</th>
            <th data-orderable="false" data-searchable="false"></th>
            <th data-orderable="false" data-searchable="false"></th>
            <th data-orderable="false" data-searchable="false"></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Kunde</th>
            <th>Werbeformat</th>
            <th>Preis</th>
            <th>Bezahlt</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </tfoot>
    <tbody>
    @foreach($issue->advertisements as $advertisement)
        <tr>
            <td data-search="{{ $advertisement->customer->name }}" data-order="{{ $advertisement->customer->name }}">@include('components.customer', ['customer' => $advertisement->customer])</td>
            <td>{{ $advertisement->adformat->name }}</td>
            <td data-order="{{ $advertisement->adformat->price }}">{{ $advertisement->adformat->price / 100 }}€</td>
            <td data-order="{{ $advertisement->paid }}"><i class="fa {{ $advertisement->paid ? 'fa-check' : 'fa-times' }}"></i></td>
            <td>@include('components.advertisement', ['advertisement' => $advertisement, 'issue' => $issue, 'linkText' => '', 'linkHtml' => '<i class="fa fa-pencil"></i>'])</td>
            <td><a href="{{ route('invoice', [$issue->id, $advertisement->customer->id]) }}" target="_blank"><i class="fa fa-file-text-o"></i></a></td>
            <td>
            @if (!$advertisement->paid)
                <form method="POST" action="{{ route('advertisements.delete', $advertisement->id) }}">{!! csrf_field() !!}<a href="#" onclick="$(this).closest('form').submit()"><i class="fa fa-trash-o"></i></a></form>
            @endif
            </td>
        </tr>
    @endforeach
    </tbody>
    </table>
@stop

@section('end')
    <script>
        $(document).ready(function() {
            $('#advertisements_table').DataTable();
        });
    </script>
@stop
