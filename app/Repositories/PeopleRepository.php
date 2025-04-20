<?php

namespace App\Repositories;

use App\Models\People;

class PeopleRepository {

    protected $model;

    public function __construct(People $model)
    {
        $this->model = $model;
    }
    public function all($perPage, $page)
    {
        return $this->model->paginate($perPage, ['*'], 'page', $page);
    }
    
    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $user = $this->model->findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = $this->model->findOrFail($id);
        $user->delete();
    }

    public function findWithPets($id)
    {
        return $this->model->with('pets')->find($id);
    }

}