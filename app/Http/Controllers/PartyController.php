<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Http\Request;

class PartyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parties = Party::all();

        return response()->json([
            'success' => true,
            'data' => $parties
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required',
            'game_id' => 'required'
        ]);

        $party = Party::create([
            'name' => $request->name,
            'game_id' => $request->game_id,
            'user_id' => auth()->user()->id
        ]);

        if ($party){
            return response()->json([
                'success' => true,
                'data' => $party->toArray()
            ], 200);

        }else{
            return response()->json([
                'success' => false,
                'message' => 'Party not create'
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Party  $party
     * @return \Illuminate\Http\Response
     */
    public function show(Party $party)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Party  $party
     * @return \Illuminate\Http\Response
     */
    public function edit(Party $party)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Party  $party
     * @return \Illuminate\Http\Response
     */

    //DATOS PARA ACTUALIZAR: NOMBRE DE LA PARTY. EL ID DE LA PARTY SE PASA POR PARAMS
    public function update(Request $request, Party $party, $id)

    {
        $party = Party::findOrFail($id);
        $party->update($request->all());
        return $party->toArray();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Party  $party
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $party = Paty::findOrFail($id);

        $party->delete();
    }
}
