<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Repositories\PostsRepository;
class PostsController extends Controller
{
    public function getAllPosts(PostsRepository $pos)
    {
        
        $posts = $pos->getPublicPosts();
        return  response()->json(compact('posts'),200);
    }

    public function getByIdPost($id,PostsRepository $pos){
        $result = $pos->getByIdPost($id);
        $post = $result['post']; 
        $latestPosts = $result['latestPosts'];
        return response()->json(compact('post','latestPosts'),200);
    } 
}
