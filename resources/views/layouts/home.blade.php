@extends('layouts.app')

@section('title')
    بازی
@endsection

@section('content')
    <div class="container">
        <div class="row">
            @foreach($games as $game)
                <div class="col-xs-10 col-sm-10 col-md-6 col-lg-4 col-xs-offset-1 col-sm-offset-1 col-md-offset-0 col-lg-offset-0">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="{{ url('/games/' . $game->id ) }}">{{ $game->name }}</a>
                        </div>
                        <div class="panel-body">
                            {{ $game->name }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
