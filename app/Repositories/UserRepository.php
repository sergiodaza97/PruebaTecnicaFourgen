<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository {

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return $this->model->all();
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

}