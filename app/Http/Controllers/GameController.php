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
    public function create(Request $request, Game $game)
    {
        //AQUI CREAMOS EL JUEGO TIPO JSON
        if($request->isJson()) {

            $data = $request->json()->all();

            //CONFIRMACIÓN PARA SABER SI EL USUARIO EXISTE
            $userExists = User::where("id", $data['user_id'])->exists();

            if($userExists === false) {
                return response()->json(['error' => 'Invalid parameters'], status:406);
            }

            $datatoBeSaved = [
                'user_id' => $data['user_id'],
                'title' => $data['title'],
                'thumbnail_url' => $data['thumbnail_url'],
            ];
            //Aqui ejecutamos la variable datatosaved, para que se guarde el juego
            $game = Game::create($datatoBeSaved);

            return response()->json($game, status:200);
        } else {
            return response()->json(['error' => 'Error not a valid JSON!!!'], status:406,);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
    }
}
