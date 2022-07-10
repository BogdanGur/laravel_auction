@extends('layouts.body')

@section('title', 'Account')

@section('content')
    <section class="panel">
        <div class="wrapper">
            <div class="admin_panel">
                <div class="left_panel">
                    <div class="admin">
                        @if($user->photo)
                            <img src="{{ \Illuminate\Support\Facades\Storage::url('public/user_photos/'.$user->photo) }}" width="100" height="100" alt="">
                        @endif
                        <div>
                            <strong>{{ $user->name }}</strong>
                            {{ $user->email }}
                        </div>

                    </div>
                    <ul>
                        <li data-sec="info">My info</li>
                        <li data-sec="lots">My Lots</li>
                    </ul>
                </div>
                <div class="right_panel">
                    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

                    <div class="panel_section info_section show_section">
                        <div class="form_block form-sec">
                            <h3>Update Information</h3>

                            <form action="{{ route("account.update_user") }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="text" name="name" value="{{ $user->name }}" placeholder="Name">
                                @if($errors->has("name"))
                                    <div class="alert alert-danger">{{ $errors->first("name") }}</div>
                                @endif

                                <input type="email" name="email" value="{{ $user->email }}" placeholder="Email">
                                @if($errors->has("email"))
                                    <div class="alert alert-danger">{{ $errors->first("email") }}</div>
                                @endif

                                <input type="tel" name="phone" value="{{ $user->phone }}" placeholder="Phone">
                                @if($errors->has("phone"))
                                    <div class="alert alert-danger">{{ $errors->first("phone") }}</div>
                                @endif

                                <div>
                                    <label for="photo">Photo</label>
                                    <input type="file" name="photo" id="photo">
                                </div>
                                @if($errors->has("photo"))
                                    <div class="alert alert-danger">{{ $errors->first("photo") }}</div>
                                @endif

                                <button>Update</button>
                            </form>
                        </div>
                    </div>

                        <div class="panel_section lots_section">
                            <div class="form_block form-sec lot_form">
                                <h3>Add Lot</h3>

                                <form action="{{ route("account.add_lot") }}" method="post" enctype="multipart/form-data" >
                                    @csrf
                                    <input type="text" name="name_lot" placeholder="Name">
                                    @if($errors->has("name_lot"))
                                        <div class="alert alert-danger">{{ $errors->first("name_lot") }}</div>
                                    @endif

                                    <textarea name="description" cols="30" rows="5"></textarea>
                                    @if($errors->has("description"))
                                        <div class="alert alert-danger">{{ $errors->first("description") }}</div>
                                    @endif

                                    <input type="text" name="start_price" placeholder="Start Price">
                                    @if($errors->has("start_price"))
                                        <div class="alert alert-danger">{{ $errors->first("start_price") }}</div>
                                    @endif

                                    <select name="category">
                                        <option value="">Category...</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has("category"))
                                        <div class="alert alert-danger">{{ $errors->first("category") }}</div>
                                    @endif

                                    <div>
                                        <label for="images">Images</label>
                                        <input type="file" name="images[]" id="images" multiple>
                                    </div>
                                    @if($errors->has("images"))
                                        <div class="alert alert-danger">{{ $errors->first("images") }}</div>
                                    @endif

                                    <button>Add</button>
                                </form>
                            </div>
                            <div class="lot_list">
                                @if(count($lots) > 0)
                                    @foreach($lots as $lot)
                                        <div class="lot lot_{{ $lot->id }}">
                                            <div class="lot_info">
                                                <div class="lot_image">
                                                    <img src="{{ \Illuminate\Support\Facades\Storage::url('public/product_images/'.$lot->image->img) }}" alt="">
                                                </div>
                                                <div class="lot_name_des">
                                                    <strong><a href="/lot/{{ $lot->url }}">{{ $lot->name }}</a></strong>
                                                    <p>{{ \Illuminate\Support\Str::words($lot->description, 10) }}</p>
                                                    <div><strong>Category: </strong>{{ $lot->category->name }}</div>
                                                    <div><strong>Start Price: </strong>{{ number_format($lot->start_price, 0, '', ' ') }}₴</div>
                                                </div>
                                            </div>
                                            <div class="lot_controll">
                                                <button type="button" class="btn btn-warning edit_lot" style="padding: 0;" data-id="{{ $lot->id }}">Edit</button>
                                                <button type="button" class="btn btn-danger delete_lot" style="padding: 0;" data-id="{{ $lot->id }}">Delete</button>
                                            </div>
                                        </div>
                                        <div class="form_block form-sec lot_form_edit lot_form_{{ $lot->id }}">
                                            <h3>Edit Lot</h3>

                                            <form action="{{ route("account.update_lot") }}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <input type="text" name="name_lot" placeholder="Name" value="{{ $lot->name }}">
                                                @if($errors->has("name_lot"))
                                                    <div class="alert alert-danger">{{ $errors->first("name_lot") }}</div>
                                                @endif

                                                <textarea name="description" cols="30" rows="5">{{ $lot->description }}</textarea>
                                                @if($errors->has("description"))
                                                    <div class="alert alert-danger">{{ $errors->first("description") }}</div>
                                                @endif

                                                <input type="text" name="start_price" placeholder="Start Price" value="{{ $lot->start_price }}">
                                                @if($errors->has("start_price"))
                                                    <div class="alert alert-danger">{{ $errors->first("start_price") }}</div>
                                                @endif

                                                <select name="category">
                                                    <option value="">Category...</option>
                                                    @foreach($categories as $cat)
                                                        <option value="{{ $cat->id }}" @if($cat->id == $lot->category_id) selected @endif>{{ $cat->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has("category"))
                                                    <div class="alert alert-danger">{{ $errors->first("category") }}</div>
                                                @endif

                                                <div>
                                                    <label for="images">Images</label>
                                                    <input type="file" name="images[]" id="images" multiple>
                                                </div>
                                                @if($errors->has("images"))
                                                    <div class="alert alert-danger">{{ $errors->first("images") }}</div>
                                                @endif
                                                <input type="hidden" name="lot_id" value="{{ $lot->id }}">

                                                <button>Update</button>
                                            </form>
                                        </div>
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
