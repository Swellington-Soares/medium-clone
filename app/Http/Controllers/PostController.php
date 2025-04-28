<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = auth()->user();

        $query = Post::with(['user', 'media'])
            ->withCount('claps')
            ->latest();

        if ($user) {
            $followingIds = $user->followings()->pluck('users.id');
            $query->whereIn('user_id', $followingIds);
        }

        $posts = $query->paginate(5);

        return view('post.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::get();
        return view(
            'post.create',
            [
                'categories' => $categories
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
        $data = $request->validated();


        $post = Post::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'category_id' => $data['category_id'],
            'user_id' => auth()->user()->id,
            'slug' => str($data['title'])->slug(),
        ]);

        $post->addMediaFromRequest('image')
            ->toMediaCollection();

        return redirect()->route('dashboard')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username, Post $post)
    {
        return view('post.show', [
            'post' => $post->with(['user', 'media'])->withCount('claps')->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }

    public function category(Category $category)
    {

        $posts = $category->posts()
            ->with(['user', 'media'])
            ->withCount('claps')
            ->latest()
            ->simplePaginate(5);

        return view('post.index', ['posts' => $posts]);

    }
}
