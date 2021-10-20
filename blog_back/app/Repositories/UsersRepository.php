<?php

namespace App\Repositories;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class UsersRepository extends BaseRepository 
{

    public function __construct(User $model)
    { 
        $this->model = $model;              
    }

    public function search($name="name",$searchValue="",$orderByValue="desc",$orderByTypeValue="created_at",$paginate="10") // zanajdowanie rekordu
    {
        $sort = $orderByValue !== "asc"  ? "desc" : "asc";
        $by = $orderByTypeValue !== "name" ? "created_at" : "name";
        $records = $paginate !== "15" ? "10" : "15";
        return $this->model::with("roles")->where($name, "LIKE", "%" . $searchValue . "%")
        ->orderBy($by,$sort) //->orderBy("created_at", "desc")     
        ->paginate($records);
    }

}