<?php

namespace App\Repositories;

use App\Models\Pet;
use App\Services\DogApiService;

class PetRepository {

    protected $model;

    public function __construct(Pet $model)
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
        $dogApi = new DogApiService();
        $dog = $dogApi->getRandomDog();
        // dd($dog);
        if ($dog) {
            $data['image'] = $dog['url'] ?? null;
            $data['breed'] = $dog['breeds'][0]['name'] ?? null;
            $data['age'] = $dog['breeds'][0]['life_span'] ?? null;
        }
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $dogApi = new DogApiService();
        $dog = $dogApi->getRandomDog();
        // dd($dog);
        if ($dog) {
            $data['image'] = $dog['url'] ?? null;
            $data['breed'] = $dog['breeds'][0]['name'] ?? null;
            $data['age'] = $dog['breeds'][0]['life_span'] ?? null;
        }
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