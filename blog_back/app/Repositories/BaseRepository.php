<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository /* klasa ustala sie jako abstrakcyjna zeby po dziedziczeniu bbyly dostepne funkcje */
{
    protected $model;

    public function getAll($coluums = array('*')) //pobirranie rekordow z domyslnym parametrem wszystko
    {
        return $this->model->get($coluums);
    }

    public function getWhereOnlyColumn($coluumn,$value,$onlyColumn = array('*')){

        return $this->model->where($coluumn,$value)->get($onlyColumn);
    }


    public function create($data) //tworzenie rekordu
    {
        return $this->model->create($data);
    }


    public function update($data, $id) // zmiana rekordu
    {
        return $this->model->where("id", '=', $id)->update($data);
    }


    public function delete($id) // usuwanie rekordu
    {
       return $this->model->destroy($id);
    }


    public function find($id) // zanajdowanie rekordu
    {
        return $this->model->find($id);
    }
    public function search($name,$searchValue,$orderByValue,$orderByTypeValue,$paginate) // zanajdowanie rekordu
    {
        return $this->model->where($name, 'LIKE', '%' . $searchValue . '%')
        ->orderBy($orderByValue,$orderByTypeValue) //->orderBy('created_at', 'desc')     
        ->paginate($paginate);
    }
    
}
/*

Wzorzec repository on nam mówi że miedzy modelem a kontrolerem trzeba utworzyć klasę pośredniczącą która by wykonywała wszelkie operacje na bazie.

Folder Repositories jest stworzony dla przechowywania klas pośredniczących


*/
