<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;

class HomeController extends Controller
{
    protected $descriptions = [
        '1' => ' ',
        '2' => 'توضیح',
        '3' => ' ',
        '4' => ' '
    ];

    protected $questions = [
        '1' => 'اعتراف میکنید؟',
        '2' => 'یک عدد بین ۱ تا ۱۰۰ انتخاب کنید',
        '3' => 'اعلام بی طرفی یا طرفداری؟',
        '4' => 'کدام را انتخاب میکنید؟'
    ];

    protected $choices = [
        '1' => [
            '0' => 'بله',
            '1' => 'خیر'
        ],
        '2' => '',
        '3' => [
            '0' => 'بی طرفی',
            '1' => 'طرفداری'
        ],
        '4' => [
            '0' => 'سینما',
            '1' => 'تئاتر'
        ]
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
        $type = '1';
        if ($game_id == 2) {
            $type = '2';
        }
        return view('games.type' . $type, [
            'game' => Game::find($game_id),
            'description' => $this->descriptions[$game_id],
            'question' => $this->questions[$game_id],
            'choices' => $this->choices[$game_id]
        ]);
    }
}
