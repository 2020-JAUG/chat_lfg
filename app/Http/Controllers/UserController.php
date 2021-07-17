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
    public function index()
    {
        // $users = auth()->user()->all();

        // return response()->json(['success' => true, 'data' => $users], 200);

        //GUARDO EL TOKEN DEL USER LOGEADO. MEDIANTE EL AUTH
        $user = auth()->user();
        $users = User::all();

        //CON LA FLECHA ACCEDEMOS A LAS PROPIEDADES DE USER
        if($user -> is_admin === true ) {//AQUI VALIDAMOS QUE SEA ADMIN
            return response()->json(['success' => true, 'data' => $users], 200);
        } else {
            return response()->json(['error' => 'You do not have access'], status:406);
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
    public function show($id)
    {
        //CONFIRMAMOS LA AUTHENTICATION
        $user = auth()->user()->find($id);

        if( $user-> id === $id) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => $user->toArray()
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
