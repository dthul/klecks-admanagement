@extends('layouts.master')

@section('title', 'Ausgabe '.$issue->name)

@section('content')
<div class="row">
<div class="small-12 columns">
    <h1>Ausgabe {{ $issue->name }} @include('components.issue', ['issue' => $issue, 'linkText' => '', 'linkHtml' => '<i class="fa fa-pencil"></i>'])</h1>
</div>
<div class="small-12 large-7 columns">
    <!-- Statistics Block Grid -->
    <div class="row small-up-1 medium-up-2">
        <div class="column">
            <p>Fällig</p>
            <div class="stat">{{ $issue->due->formatLocalized('%d.%m.%y') }}</div>
        </div>
        <div class="column">
            <p>Anzeigen</p>
            <div class="stat">{{ count($issue->advertisements) }}</div>
        </div>
        <div class="column">
            <p>Seiten</p>
            <div class="stat">TODO</div>
        </div>
        <div class="column">
            <p>Einnahmen</p>
            <div class="stat">{{ number_format($issue->advertisements->pluck('adformat')->pluck('price')->sum() / 100, 2, ',', '.') }} €</div>
        </div>
    </div>
</div>
<div class="small-12 large-5 columns">
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
    @foreach($issue->adformats()->orderBy('name')->get() as $adformat)
        <tr>
            <td>{{ $adformat->name }}</td>
            <td>{{ number_format($adformat->price / 100, 2, ',', '.') }} €</td>
            <td>@include('components.adformat', ['adformat' => $adformat, 'linkText' => '', 'linkHtml' => '<i class="fa fa-pencil"></i>'])</td>
            <td><form method="POST" action="{{ route('adformats.delete', $adformat->id) }}">{!! csrf_field() !!}<a href="#" onclick="$(this).closest('form').submit()"><i class="fa fa-trash-o"></i></a></form></td>
        </tr>
    @endforeach
    <tr>
        <td colspan="4">@include('components.adformat', ['adformat' => null, 'issue' => $issue])</td>
    </tr>
    </tbody>
    </table>
</div>
<div class="small-12 columns">
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
            <td data-order="{{ $advertisement->adformat->price }}" class="text-right">{{ number_format($advertisement->adformat->price / 100, 2, ',', '.') }} €</td>
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
</div>
</div>
@stop

@section('end')
    <script>
        $(document).ready(function() {
            $('#advertisements_table').DataTable();
        });
    </script>
@stop
