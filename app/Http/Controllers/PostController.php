<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Membership;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //CONFIRMAMOS QUE EXISTA
        $posts = auth()->user()->posts;

        return response()->json(['success' => true, 'data' => $posts], 200);
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

        $user = auth()->user();

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'party_id' => 'required'
        ]);

        //PARA COMPROBAR QUE ESTE EN LA PARTY
        $verify = Membership::where('party_id', '=', $request->party_id)->where('user_id', '=', $user->id)->get();

        if ($verify->isEmpty()) {

            return response()->json([
                'success' => false,
                'message' => 'You are not at this party'
            ], 500);
        } else {

            $message = Post::create([
                'description' => $request->description,
                'title' => $request->title,
                'user_id' => $user->id,
                'party_id' => $request->party_id,
            ]);

            return response()->json([
                'success' => true,
                'data' => $message->toArray()
            ]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //CONFIRMAMOS LA AUTHENTICATION. PARA MOSTRAR LOS POSTS DEL USER LOGEADO. Y LISTAMOS SUS POSTS
        $post = auth()->user()->posts()->find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => $post->toArray()
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    public function postOnParties(Request $request)
    {
        $post = Post::where('party_id', $request->party_id)->get();

        $this->validate($request, [
            'party_id' => 'required',
        ]);

        if ($post->isEmpty()) {

            return response()->json([
                'success' => false,
                'message' => 'You are not at this party'
            ], 500);
        } else {

            return response()->json([
                'success' => true,
                'data' => $post,
            ], 200);
        }
    }
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = auth()->user()->posts()->find($id);
        $user = auth()->user();

        if ( $post->user_id != $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'You are not the creator of this post'
            ], 400);
        }

        $updated = $post->update([
            'title' => $request->input('title'),
            'description' => $request->input('description')
        ]);
        if ($updated) {

            return response()->json([
                'success' => true,
                'message' => 'Message with title ' . $post->title . ' has been update'
            ], 200);
        } else {

            return response()->json([
                'success' => false,
                'message' => 'Post can not be updated'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = auth()->user()->posts()->find($id);

        $post = Post::findOrFail($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found',
            ], 400);
        }

        //AQUI EJECUTAMOS LA ACCIÓN
        if ($post->delete()) {
            return response()->json([
                'success' => true,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'You are not the creator of this post',
            ], 500);
        }
    }
}
