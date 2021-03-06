<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

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

        if($user ) {
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

        $user = auth()->user();

        $this->validate($request, [
            // 'user_id' => 'required',
            'party_id' => 'required',
        ]);

        $membership = Membership::where('party_id', '=', $request->party_id)->where('user_id', '=', $user->id)->get();

        if ($membership->isEmpty()) {

            $data = Membership::create([
                'user_id' => $user->id,
                'party_id' => $request->party_id,
            ]);

            if($data) {
                return response()->json([
                    'success' => true,
                    'data' => $data
                ], 200);
            }

        } else {

            return response()->json([
                'success' => false,
                'data' => 'you are already at this party :)'
            ], 400);
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
    public function destroy($party_id)
    {
        $user = auth()->user();

        $data = Membership::where('party_id', '=', $party_id)->where('user_id', '=', $user->id)->get();

        if($data->isEmpty()) {

            return response()->json([
                'success' => false,
                'message' => "You are not at this party"
            ], 400);
        }else {

            $data = Membership::selectRaw('id')
            ->where('party_id', '=', $party_id)
            ->where('user_id', '=', $user->id)->delete();

             return response()->json([
                'success' => true,
                'messate' => "You left the party"
             ], 200);
        }
    }
}
