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
                        <?php $i = 0 ?>
                        @foreach($choices as $choice)
                            <input type="radio" name="choice" value="{{ $i++ }}">{{ $choice }} </br>
                        @endforeach
                    </div>
                    <button id ="submit_record" class="btn btn-primary" onclick="submitChoice({{ $game->id }}, {{\Illuminate\Support\Facades\Auth::id()}})">ثبت
                        <i id="button_icon" class="fa fa-circle-o-notch fa-spin"></i>
                    </button>
                </div>
                <div class="game_response" style="display: none">
                    <h5 id="win_or_lose"></h5>
                    <div style="margin-top: 50px">
                        <span>شما با کاربر </span>
                        <span id="user_name_field" style="color: #2e6da4"></span>
                        <span> بازی کردید و او گزینه </span>
                        <span id="enemy_chocie" style="color: #ff6666;"></span>
                        <span>را انتخاب کرد</span>
                        {{--<span>امتیاز شما</span>--}}
                        {{--<span id="your_score" style="color: #ff6666;"></span>--}}

                        <br>
                        <br>
                    </div>
                </div>
                <table class="table" style="text-align: center;">
                    <thead>
                    <tr>
                        <th class="col-xs-1 col-sm-1 col-md-1 col-lg-1">#</th>
                        <th class="col-xs-3 col-sm-3 col-md-3 col-lg-3">بازیکن ۱</th>
                        <th class="col-xs-3 col-sm-3 col-md-2 col-lg-2">انتخاب</th>
                        <th class="col-xs-3 col-sm-3 col-md-2 col-lg-2">بازیکن ۲</th>
                        <th class="col-xs-3 col-sm-3 col-md-2 col-lg-2">انتخاب</th>
                    </tr>
                    </thead>
                    <?php $i = 1 ?>
                    <?php

                    ?>
                    @foreach(\Illuminate\Support\Facades\Auth::user()->records->where('game_id', $game->id) as $record)
                        {{--                                @foreach($record->match->records as $rec)--}}
                        <tr>
                            <td>{{ $i }}</td>
                            @if($record->match != null)
                                <td>{{ $record->match()->first()->records()->get()[0]->user->name }}</td>
                                <td>{{ $record->match()->first()->records()->get()[0]->score+1 }}</td>
                                <td>{{ $record->match()->first()->records()->get()[1]->user->name }}</td>
                                <td>{{ $record->match()->first()->records()->get()[1]->score+1 }}</td>
                            @endif
                        </tr>
                        <?php $i++ ?>
                        {{--@endforeach--}}
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection