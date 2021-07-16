<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'title' => 'required',
            'thumbnail_url' => 'required',

        ]);

        $game = Game::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'thumbnail_url' => $request->thumbnail_url,
        ]);

        if (!$game) {
            return response() ->json([
                'success' => false,
                'data' => 'Game not created'], 400);
        } else {
            return response() ->json([
                'success' => true,
                'data' => $game,
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        $games = Game::all();

        if(!$games) {
            return response()->json([
                'success' => false,
                'message' => 'No games found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $games
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game, $id)
    {
        $game = Game::findOrFail($id);
        $game->update($request->all());
        return $game;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $game = Game::findOrFail($id);

        $game->delete();
    }
}
