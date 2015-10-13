@extends('layouts.master')

@section('title', 'Ausgaben')

@section('content')
    <h1>Ausgaben</h1>
    <ul>
    @foreach($issues as $issue)
        <li>{{ $issue->name }}</li>
    @endforeach
    </ul>
@stop