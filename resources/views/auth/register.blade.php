@extends('layouts.body')

@section('title', 'Register')

@section('content')
    <section class="form-sec">
        <div class="wrapper">
            <h3>Register</h3>

            <form action="{{ route("register") }}" method="post">
                @csrf
                <input type="text" name="name" placeholder="Name">
                @if($errors->has('name'))
                    <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                @endif

                <input type="email" name="email" placeholder="Email">
                @if($errors->has('email'))
                    <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                @endif

                <input type="tel" name="phone" placeholder="Phone">
                @if($errors->has('phone'))
                    <div class="alert alert-danger">{{ $errors->first('phone') }}</div>
                @endif

                <input type="password" name="password" placeholder="Password">
                @if($errors->has('password'))
                    <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                @endif

                <input type="password" name="password_confirmation" placeholder="Confirm Password">

                <button>Register</button>
            </form>
        </div>
    </section>
@endsection
