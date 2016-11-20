@extends('layouts.master')

@section('title', 'Benutzer')

@section('content')
<div class="row">
    <div class="small-12 large-6 columns">
        <h1>Benutzer</h1>
        <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>E-Mail</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
            </tr>
        @endforeach
        </tbody>
        </table>
    </div>
    <div class="small-12 large-6 columns">
        <h1>Benutzer hinzufügen</h1>
        <form method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}
            <label>Name
                <input type="text" name="name" value="{{ old('name') }}" required autofocus>
            </label>
            <label>E-Mail
                <input type="email" name="email" value="{{ old('email') }}" required>
            </label>
            <label>Passwort
                <input type="password" name="password" required>
            </label>
            <label>Wiederholung
                <input type="password" name="password_confirmation" required>
            </label>
            <button type="submit" class="button">
                Anlegen
            </button>
        </form>
    </div>
</div>
@endsection
