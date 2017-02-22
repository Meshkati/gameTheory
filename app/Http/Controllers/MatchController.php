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
        $opponent = '';
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
            $r2 = $match->records->where('id', '!=', $record->id)->pop();
            $opponent = $r2->user;
            $wl = '';
            if ($r2->score < $record->score) {
                $wl = 'win';
            } else {
                $wl = 'lose';
            }
            $matchInfo = [
                'enemy_choice' => $r2->score,
                'message' => 'haha',
                'wl' => $wl
            ];
        }

        $res = response()->json([
            'status' => $status,
            'record' => $record,
            'opponent' => $opponent,
            'match' => $matchInfo
        ]);

        return $res;
    }

    public function checkRecordStatus($game_id, $record_id) {
        $r = Record::findOrFail($record_id);
        $res = response()->json([
            'status' => 'nothing'
        ]);
        if ($r->match()->count() != 0) {
            $r2 = $r->match->records->where('id', '!=', $r->id)->pop();
            if ($r2->score < $r->score) {
                $wl = 'win';
            } else {
                $wl = 'lose';
            }
            $res = response()->json([
                'status' => 'match',
                'record' => $r,
                'opponent' => $r2->user,
                'match' => [
                    'enemy_choice' => $r2->score,
                    'message' => 'hoohoo',
                    'wl' => $wl
                ]
            ]);
        }
        return $res;
    }
}
