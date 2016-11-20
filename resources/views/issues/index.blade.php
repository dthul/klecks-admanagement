@extends('layouts.master')

@section('title', 'Ausgaben')

@section('content')
<div class="row">
<div class="small-12 columns">
    <h1>Ausgaben</h1>
</div>
<div class="small-12 columns">
    <p>@include('components.issue', ['issue' => null])</p>

    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Erstellt am</th>
            <th>Fällig am</th>
            <th></th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Name</th>
            <th>Erstellt am</th>
            <th>Fällig am</th>
            <th></th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($issues as $issue)
            <tr>
                <td><a href="{{ route('issues.issue', $issue->id) }}">{{ $issue->name }}</a></td>
                <td>{{ $issue->created_at->formatLocalized('%A, %d. %B %Y') }}</td>
                <td>{{ $issue->due->formatLocalized('%A, %d. %B %Y') }}</td>
                <td><form method="POST" action="{{ route('issues.delete', $issue->id) }}">{{ csrf_field() }}<a href="#" onclick="$(this).closest('form').submit()"><i class="fa fa-trash-o"></i></a></form></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</div>
@stop