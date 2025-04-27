<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class ClapController extends Controller
{
    public function clap(Post $post)
    {

        if (!auth()->user()->hasClapped($post)) {
            $post->claps()->create([
                "user_id" => auth()->id()
            ]);
        } else {
          $post->claps()->where("user_id", auth()->id())->delete();
        }

        return response()->json([
            "count" => $post->claps()->count()
        ]);
    }
}
