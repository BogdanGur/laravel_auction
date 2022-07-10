@extends('layouts.body')

@section('title', 'Login')

@section('content')
    <section class="form-sec">
        <div class="wrapper">
            <h3>Login</h3>

            <form action="{{ route("login") }}" method="post">
                @csrf
                <input type="email" name="email" placeholder="Email">
                @if($errors->has('email'))
                    <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                @endif

                <input type="password" name="password" placeholder="Password">
                @if($errors->has('password'))
                    <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                @endif

                <button>Login</button>
            </form>
        </div>
    </section>
@endsection
