<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\AuthorNotBelongsTo;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Post\PostCollection;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return PostResource::collection(Post::paginate(5));
        return PostCollection::collection(Post::latest()->paginate(5));
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
    public function store(PostRequest $request)
    {
        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = str::title($request->title);
        $post->slug = str::slug($request->title);
        $post->about = $request->about;
        $post->image = $request->image;
        $post->is_approved = $request->is_approved;
        $post->status = $request->status;
        $post->save();
        return response([
             'data' => new PostResource($post)
        ], Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {   
        $this->authorCheck($post);
        $post->update($request->all());
        return response([
            'data' => new PostResource($post)
       ], Response::HTTP_CREATED);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {   
        $this->authorCheck($post);
        $post->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
    public function authorCheck($post){
        if(Auth::id() !== $post->user_id){
            throw new AuthorNotBelongsTo;
        }
    }
}
