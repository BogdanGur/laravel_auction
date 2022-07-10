@extends('admin.layouts.body')

@section('title', 'Login')

@section('content')
    <section class="form-sec">
        <div class="wrapper">
            <h3>Login</h3>

            <form action="{{ route("admin.login") }}" method="post">
                @csrf
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">

                <button>Login</button>
            </form>
        </div>
    </section>
@endsection
