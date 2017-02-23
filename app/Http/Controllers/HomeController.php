<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;

class HomeController extends Controller
{
    protected $descriptions = [
        '1' => 'در این بازی باید فلانی را لو بدهید',
        '2' => 'توضیح'
    ];

    protected $questions = [
        '1' => 'چیکار میکنی؟ لو میدی یا نه؟',
        '2' => 'یک عدد بین ۱ تا ۱۰۰ انتخاب کنید'
    ];

    protected $choices = [
        '1' => [
            '0' => 'بله',
            '1' => 'خیر'
        ],
        '2' => ''
    ];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.home', [
            'games' => Game::all()
        ]);
    }
    public function showGame($game_id) {
        return view('games.type1', [
            'game' => Game::find($game_id),
            'description' => $this->descriptions[$game_id],
            'question' => $this->questions[$game_id],
            'choices' => $this->choices[$game_id]
        ]);
    }
}
