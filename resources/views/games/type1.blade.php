@extends('layouts.app')

@section('title')
    {{ $game->name }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-md-10 col-lg-8 col-xs-offset-0 col-sm-offset-1 col-md-offset-1 col-lg-offset-2">
                <h1>{{ $game->name }}</h1>
                <div class="game_description">
                    {{ $description }}
                </div>

                <div class="game_container">
                    <h5>{{ $question }}</h5>
                    <div class="game_choices">
                        <?php $i = 0 ?>
                        @foreach($choices as $choice)
                            <input type="radio" name="choice" value="{{ $i++ }}">{{ $choice }} </br>
                        @endforeach
                    </div>
                    <button class="btn btn-primary" onclick="submitChoice({{ $game->id }}, {{\Illuminate\Support\Facades\Auth::id()}})">ثبت</button>
                </div>
            </div>
        </div>
    </div>
@endsection