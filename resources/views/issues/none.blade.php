@extends('layouts.master')

@section('title', 'Ausgaben')

@section('content')
    <h1>Neue Ausgabe</h1>
    <p>
        Es sieht so aus als würde noch keine Ausgabe existieren. {!! link_to_route('issues.new', 'Lege jetzt eine neue an') !!}.
    </p>
@stop