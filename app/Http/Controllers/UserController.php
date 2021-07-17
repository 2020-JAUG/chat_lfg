<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        //GUARDO EL TOKEN DEL USER LOGEADO. MEDIANTE EL AUTH
        $user = auth()->user()->find($id);

        //CON LA FLECHA ACCEDEMOS A LAS PROPIEDADES DE USER
        if(!$user) {
            return response()->json(['success' => true, 'data' => $user], 200);
        } else {
            return response()->json([
                'success' =>  false,
                'message' => 'User not found',
            ], 400);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //CONFIRMAMOS LA AUTHENTICATION
        $user = auth()->user();
        $users = User::all();

        if( $user-> id === 5) {//AQUI VALIDAMOS QUE SEA ADMIN
            return response()->json([
                'success' => false,
                'message' => 'You do not have access'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => $users->toArray()
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, $id)
    {
        //BUSCAMOS EL ID PASAMOS POR PARÁMETROS PARA LOCALIZARLO Y ACTUALIZAR
        $user = User::findOrFail($id);
        $user->update($request->all());
        return $user;
        // return response()->json($user, status:200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();
    }

    public function logout(Request $request)
    {

        $token =  $request->user()->token();
        $token -> revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
     }
}
