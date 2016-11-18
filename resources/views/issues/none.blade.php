@extends('layouts.master')

@section('title', 'Ausgaben')

@section('content')
<div class="row">
    <div class="small-12 columns">
        <h1>Neue Ausgabe</h1>
        <p>
            Es sieht so aus als würde noch keine Ausgabe existieren. <a href="{{ route('issues.index') }}">Neue Ausgabe anlegen</a>.
        </p>
    </div>
</div>
@stop