<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repositories\PostsRepository;

class HomeAdminController extends Controller
{
    public function index(PostsRepository $rep)
    {
        $postsOllCount = $rep->getAll()->count();
        $postPublicCount = $rep->getAll()->where('status', 1)->count();

        return view('admin.index', [
            'postsOllCount' => $postsOllCount,
            'postPublicCount' => $postPublicCount
        ]);
    }
}
