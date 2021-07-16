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
    public function title($title)
    {

        $game = Game::where('title', $title)->get();
        if(!$game) {
            return response()->json([
                'success' => false,
                'message' => 'Game: .' . $request->title . 'not found'
            ], 400);
        }
        return response()->json([ 'success' => true,'data' => $game,], 200);
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

    public function getGameById(Request $request, $id)
    {
        $game = Game::where('id', $id)->get();
        return response() ->json([
            'success' => true,
            'data' => $game,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */

    //MUESTRA TODOS LOS JUEGOS PASANDO EL ID DEL USER POR PARAMS
    public function all()
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

     //RUTA PARA ACTUALIZAR LOS DATOS DEL JUEGO. NOMBRE Y IMAGE_URL
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
