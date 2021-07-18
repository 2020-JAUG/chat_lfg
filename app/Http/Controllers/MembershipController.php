<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //GUARDO EL TOKEN DEL USER LOGEADO. MEDIANTE EL AUTH
        $user = auth()->user();
        $Membership = Membership::all();

        //CON LA FLECHA ACCEDEMOS A LAS PROPIEDADES DE USER
        if($user -> is_admin == true ) {//AQUI VALIDAMOS QUE SEA ADMIN
            return response()->json(['success' => true, 'data' => $Membership], 200);
        }
        return response()->json(['error' => 'You do not have access'], status:406);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //eviar dos datos userID y partyId
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function entryPArty(Request $request)
     {
        $this->validate($request, [
            'user_id' => 'required',
            'party_id' => 'required',
        ]);

        $membership = Membership::create([
            'user_id' => $request->user_id,
            'party_id' => $request->party_id,
        ]);

        $membership = Membership::where('party_id', '=', $request->party_id)->where('user_id', '=', $user->id)->get();


        if ($membership) {

            return response()->json([
                'success' => false,
                'data' => 'you are already at this party :)'
            ], 400);
        } else {

            return response()->json([
                'success' => true,
                'data' => $membership,
            ], 200);
        }
     }
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function show(Membership $membership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function edit(Membership $membership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Membership $membership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membership $membership)
    {
        //
    }
}
