<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Record;
use App\Game;
use App\Match;

class MatchController extends Controller
{
    public function storeRecord(Request $request, $game_id){
        $matchInfo = '';
        $status = 'record'; // default
        $game = Game::findOrFail($game_id);
        $record = Record::create(['score' => $request->input('choice'), 'user_id' => $request->input('user'), 'isAvailable' => true]);
        $game->records()->save($record);
        $aRecord = $game->records->where('isAvailable', true);
        if ($aRecord->count() == 2) {
            $match = new Match();
            $match->save();
            $match->records()->saveMany($aRecord);
            foreach ($aRecord as $rec) {
                $rec->isAvailable = false;
                $rec->update();
            }
            $status = 'match';
            $matchInfo = $match->records->all();
        }

        $res = response()->json([
            'status' => $status,
            'record' => $record,
            'match' => $matchInfo
        ]);

        return $res;
    }
}
