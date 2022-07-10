@extends('layouts.body')

@section('title', 'Home')

@section('content')
    <section>
        <div class="wrapper">
            <div class="catalog_container">
                <div class="filter_block form-sec">
                    <h4>Categories</h4>
                    <form action="/" method="get">
                        @foreach($category as $cat)
                            <span>
                                <input type="checkbox" name="category" id="category_{{ $cat->id }}" value="{{ $cat->id }}">
                                <label for="category_{{ $cat->id }}">{{ $cat->name }}</label>
                            </span>
                        @endforeach

                        <button>Apply</button>
                    </form>
                    @if(\request('category'))
                        <a href="{{ route('home') }}" class="reset_but">Reset</a>
                    @endif
                </div>
                <div class="catalog_block">
                    <div class="lots_catalog">
                        @if(count($lots) > 0)
                            @foreach($lots as $lot)
                                <div class="lot_sec">
                                    <div class="lot-cat-img">
                                        <a href="/lot/{{ $lot->url }}">
                                            <img src="{{ \Illuminate\Support\Facades\Storage::url('public/product_images/'.$lot->image->img) }}" alt="">
                                        </a>
                                    </div>
                                    <div class="lot-cat-info">
                                        <h4><a href="/lot/{{ $lot->url }}">{{ $lot->name }}</a></h4>
                                        <p>{{ \Illuminate\Support\Str::words($lot->description, 10) }}</p>
                                        @if(!$lot->last_bet)
                                            <span class="lot-price">{{ number_format(round($lot->start_price), 0, '', ' ') }} ₴</span>
                                        @else
                                            <span class="lot-price">{{ number_format(round($lot->last_bet->bet), 0, '', ' ') }} ₴</span>
                                            <span class="lot-last-bet" style="margin-left: 10px;"><img src="{{ \Illuminate\Support\Facades\Storage::url('public/user_photos/'.$lot->last_bet->user->photo) }}" alt="" width="20" height="20" style="border-radius: 100%;"> <small>{{ $lot->last_bet->user->name }}</small></span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-success">Empty</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
