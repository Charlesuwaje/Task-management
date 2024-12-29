@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Login</h1>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Login</button>
        <a href="{{ route('password.request') }}" class="btn btn-link">Forgot Password?</a>
    </form>
</div>
@endsection
