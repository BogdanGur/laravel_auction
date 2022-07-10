@extends('admin.layouts.body')

@section('title', 'Admin Account')

@section('content')
    <section class="panel">
        <div class="wrapper">
            <div class="admin_panel">
                <div class="left_panel">
                    <div class="admin">
                        <strong>{{ $admin->name }}</strong>
                        {{ $admin->email }}
                    </div>
                    <ul>
                        <li data-sec="category">Categories</li>
                        <li data-sec="users">Users</li>
                    </ul>
                </div>
                <div class="right_panel">
                    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

                    <div class="panel_section category_section show_section">
                        <div class="form_block form-sec">
                            <h3>Add Category</h3>

                            <form action="{{ route("admin.add_category") }}" method="post">
                                @csrf
                                <input type="text" name="name" placeholder="Category Name">

                                <button>Add</button>
                            </form>
                        </div>
                        <div class="category_list">
                            @if(count($categories) > 0)
                                @foreach($categories as $cat)
                                    <div class="cat cat_{{ $cat->id }}"><strong>{{ $cat->name }}</strong> <button type="button" class="btn btn-danger" data-id="{{ $cat->id }}">Delete</button></div>
                                @endforeach
                            @else
                                <div class="alert alert-success">Empty</div>
                            @endif
                        </div>
                    </div>

                        <div class="panel_section users_section">
                            <div class="users_list">
                                @if($users)
                                    @foreach($users as $user)
                                        <div class="user user_{{ $user->id }}"><strong>{{ $user->name }}</strong> <button type="button" class="btn btn-danger" data-id="{{ $user->id }}">Delete</button></div>
                                    @endforeach
                                @else
                                    <div class="alert alert-success">Empty</div>
                                @endif
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
@endsection
