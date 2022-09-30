@extends('layouts.auth')

@section('title')
    Login
@endsection

@section('content')
    <div class="login-wrapper">
        <div class="login-box">
            <form action="{{ route('login.process') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Username">
                </div>
                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <br>
                <button type="submit" class="btn btn-primary" style="width: 100%">
                    Login
                </button>
            </form>
        </div>
    </div>
@endsection
