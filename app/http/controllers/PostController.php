<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);
        if(!$request->title || !$request->content){
            return response()->json(['message' => 'Preencha todos os campos.']);
        }
        else{
            $post = new Post();
            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->save();

            return response()->json(['message' => 'Post inserido com sucesso!']);
        }
    }
}
