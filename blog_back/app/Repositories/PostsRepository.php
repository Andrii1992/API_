<?php

namespace App\Repositories;

use App\Models\Posts;
use DB;
use SebastianBergmann\Environment\Console;

class PostsRepository extends BaseRepository //tworzymy zwykla klase
{     

    public function __construct(Posts $model)
    { /*tworzymy konstruktor gdzie przypisujemy model */
        $this->model = $model;               /*dzieki temu ze w klasie bazowej jest zmienna model mozemy przepisac model urzytkownika*/
    }

    public function search($name="title",$searchValue="",$orderByValue="desc",$orderByTypeValue="created_at",$paginate="10") // zanajdowanie rekordu
    {
        $sort = $orderByValue !== "asc"  ? "desc" : "asc";
        $by = $orderByTypeValue !== "title" ? "created_at" : "title";
        $records = $paginate !== "15" ? "10" : "15";

        return $this->model->where($name, "LIKE", "%" . $searchValue . "%")
        ->orderBy($by,$sort)    
        ->paginate($records);
    }

    public function getPublicPosts()
    { 
        $posts = Posts::orderBy('updated_at', 'DESC')->where('status', 1)->paginate(8);
        return $posts;
    }

    public function getByIdPost($id){
        $post = Posts::find($id);  
        $latestPosts= Posts::all()->where('status', 1)->where('id', '!=' , $id)->sortByDesc('updated_at')->take(3); //->paginate(3, 'created_at', 'DESC');
        return ['post' => $post,'latestPosts' => $latestPosts]; 
    } 


}
