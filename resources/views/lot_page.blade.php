@extends('layouts.body')

@section('title', $lot->name)

@section('content')
    <section>
        <div class="wrapper">
            @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
            <div class="lot-container">
                <div class="lot-images-block">
                    @if($lot->images)
                        <div class="lot-images">
                            @foreach($lot->images as $image)
                                <div class="lot-image"><img src="{{ \Illuminate\Support\Facades\Storage::url('public/product_images/'.$image->img) }}" alt=""></div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="lot-info-block">
                    <div class="lot_info">
                        <h1 class="lot_name">{{ $lot->name }}</h1>
                        <p class="lot_description">{{ $lot->description }}</p>
                        <div class="lot_category"><strong>Category:</strong> {{ $lot->category->name }}</div>
                    </div>
                    <div class="lot_price_bet">
                        <div class="lot_price">{{ round($lot->start_price) }} ₴</div>
                        <div class="lot_bet_price">
                            <form action="{{ route('lot.bet') }}" method="post">
                                @csrf
                                @if(count($bets) > 0)
                                    @php $price_bet = $lot->last_bet->bet+($lot->last_bet->bet/100)*20 @endphp
                                    <input type="number" min="{{ $price_bet }}" name="price" value="{{ round($price_bet) }}">
                                @else
                                    <input type="number" min="{{ $lot->start_price }}" name="price" value="{{ round($lot->start_price) }}">
                                @endif
                                <input type="hidden" name="lot_id" value="{{ $lot->id }}">
                                <button>Bet</button>
                            </form>
                        </div>
                    </div>
                    <div class="lot_bet_list">
                        @if(count($bets) > 0)
                            @php $i = 1; @endphp
                            @foreach($bets as $bet)
                                <div class="lot_bet">
                                    <span class="user_name">{{ $i }}.
                                        @if($bet->user->photo)
                                            <img src="{{ \Illuminate\Support\Facades\Storage::url('public/user_photos/'.$bet->user->photo) }}" alt="" width="20" height="20" style="border-radius: 100%;">
                                        @endif
                                        <strong>{{ $bet->user->name }}</strong>
                                    </span>
                                    <span class="user_bet">{{ $bet->bet }} ₴</span>
                                </div>
                                @php $i++; @endphp
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
