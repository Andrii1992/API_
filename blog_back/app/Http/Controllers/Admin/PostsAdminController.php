<?php

namespace App\Http\Controllers\admin;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\PostsRepository;

class PostsAdminController extends Controller
{
    public function create()
    {
        return view('admin.posts.create');
    }

    public function createStore(Request $req, PostsRepository  $post)
    {
        $req->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'excerpt' => 'required|max:255',
            'type' => 'nullable|max:255',
            'img' => 'nullable|mimes:jpeg,bmp,png,svg|max:16000',
            'img_thumb' => 'nullable|mimes:jpeg,bmp,png,svg|max:16000'
        ]);

        if ($req->img != null) {
            $img_name = time() . '-' . $req->img->getFilename() . '_img_' . '.' . $req->img->extension();
            $req->img->move(public_path('img/gallery'), $img_name);
        } else {
            $img_name = null;
        }
        if ($req->img_thumb != null) {
            $img_thumb_name = time() . '-' . $req->img_thumb->getFilename() . '_img_thumb_' . '.' . $req->img_thumb->extension();
            $req->img_thumb->move(public_path('img/gallery'), $img_thumb_name);
        } else {
            $img_thumb_name = null;
        }

        $post->create(
            array(
                'title' => $req->input('title'),
                'content' => $req->input('content'),
                'excerpt' =>  $req->input('excerpt'),
                'type' => $req->input('type'),
                'status' => $req->input('status') ? 1 : 0,
                'img' => $img_name,
                'img_thumb' => $img_thumb_name,
            )
        );
    
       return redirect('admin/posty');
    }

    public function editStore(Request $req, PostsRepository $rep)
    {
        $req->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'excerpt' => 'required|max:255',
            'type' => 'nullable|max:255',
            'img' => 'nullable|mimes:jpeg,bmp,png,svg|max:16000', //16000 2 mb
            'img_thumb' => 'nullable|mimes:jpeg,bmp,png,svg|max:16000'
        ]);
        $post = $rep->find($req->input('id'));
        $post->title = $req->input('title');
        $post->content = $req->input('content');
        $post->excerpt = $req->input('excerpt');
        $post->type = $req->input('type');
        $post->status = $req->input('status') ? 1 : 0;

        if ($req->img != $post->img && $req->img != null) {
            if (file_exists(public_path('img/gallery' . '/' . $post->img) && $post->img != null)) {
                unlink(public_path('img/gallery' . '/' . $post->img));
            }
            $img_name = time() . '-' . $req->img->getFilename() . '_img_' . '.' . $req->img->extension();
            $req->img->move(public_path('img/gallery'), $img_name);
            $post->img = $img_name;
        }
        if ($req->img_thumb != $post->img_thumb && $req->img_thumb != null) {
            if (file_exists(public_path('img/gallery' . '/' . $post->img_thumb) && $post->img_thumb != null)) {
                unlink(public_path('img/gallery' . '/' . $post->img_thumb));
            }
            $img_thumb_name = time() . '-' . $req->img_thumb->getFilename() . '_img_thumb_' . '.' . $req->img_thumb->extension();
            $req->img_thumb->move(public_path('img/gallery'), $img_thumb_name);
            $post->img_thumb = $img_thumb_name;
        }

        $post->save();
        return redirect('admin/posty');
    }

    public static function search(PostsRepository $posts, Request $req)
    {
        $postsS = $posts->search('title', $req->search, 'created_at', 'desc', 10)->appends(request()->input());

        return view('admin.posts.search', ["posts" => $postsS, "search" => $req->search]);
    }

    public function showPostsEdition(PostsRepository $posts, Request $req)
    {
        $dane = $posts->search('title', $req->ser, $req->sort, $req->by, $req->records)->appends(request()->input());
        return view('admin.posts.show', ["dane" => $dane, "ser" => $req->ser, "sort" => $req->sort, "by" => $req->by, "records" => $req->records]);
    }

    public function edit(PostsRepository $posts, $id)
    {
        $id= preg_replace('/[^0-9]/', '', $id);        
        $post = $posts->find($id);
        return view('admin.posts.edit', ["post" => $post]);
    }

    public function delete(PostsRepository $post, $id) //usuwanie postu razem z zdjenciami
    {
        $id= preg_replace('/[^0-9]/', '', $id); 
        $post = $post->find($id);
        if ($post !== null) {
            $image_path = public_path('img/gallery' . '/' . $post->img);
            $image_path = 'img/gallery' . '/' . $post->img;
            if (file_exists($image_path) && ($post->img != null)) {
                unlink(public_path('img/gallery' . '/' . $post->img));
            }
            $image_path_t = public_path('img/gallery' . '/' . $post->img_thumb);
            if (file_exists($image_path_t) && ($post->img_thumb != null)) {
                unlink(public_path('img/gallery' . '/' . $post->img_thumb));
            }

            $post->delete();
            return redirect('admin/posty')->with('message', $post);
        }
        return redirect('admin/posty');
    }
}
