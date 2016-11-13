@extends('layouts.master')

@section('title', 'Ausgaben')

@section('content')
<div class="row">
    <div class="small-12 columns">
        <h1>Neue Ausgabe</h1>
        <p>
            Es sieht so aus als würde noch keine Ausgabe existieren. {!! link_to_route('issues.index', 'Lege jetzt eine neue an') !!}.
        </p>
    </div>
</div>
@stop