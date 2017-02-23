@extends('layouts.app')

@section('title')
    {{ $game->name }}
@endsection

@section('content')
    <script>
        $(document).ready(function(){
            $('#button_icon').hide();
        });
    </script>
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
                        <input type="number" id="number_input">
                    </div>
                    <button id ="submit_record" class="btn btn-primary" onclick="submitChoice({{ $game->id }}, {{\Illuminate\Support\Facades\Auth::id()}})">ثبت
                        <i id="button_icon" class="fa fa-circle-o-notch fa-spin"></i>
                    </button>
                </div>
                <div class="game_response" style="display: none">
                    <h5 id="win_or_lose"></h5>
                    <div style="margin-top: 50px">
                        <span>کاربر </span>
                        <span id="user_name_field" style="color: #2e6da4"></span>
                        <span>قهرمان شد!</span>
                        <span id="enemy_chocie" style="color: #ff6666;"></span>
                        <span>را انتخاب کرد</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection