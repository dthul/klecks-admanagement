@extends('layouts.master')

@section('title', 'Login')

@section('content')
<div class="row">
    <div class="small-12 large-6 columns">
        <h1>Login</h1>
        <form method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}
            <label>E-Mail
                <input type="email" name="email" value="{{ old('email') }}" required autofocus>
            </label>
            <label>Passwort
                <input id="password" type="password" class="form-control" name="password" required>
            </label>
            <label>
                <input type="checkbox" name="remember"> Eingeloggt bleiben
            </label>
            <button type="submit" class="button">
                Login
            </button>
        </form>
    </div>
</div>
@endsection
