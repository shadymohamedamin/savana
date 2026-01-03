<?php
// app/Repositories/BaseRepository.php

/*namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseRepository
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function all(): Collection
    {
        return $this->model->all();
    }

 
    public function paginate(int $limit): LengthAwarePaginator
    {
        return $this->model->paginate($limit);
    }

    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }


    public function create(array $data): Model
    {
        return $this->model->create($data);
    }


    public function update(int $id, array $data): bool
    {
        $record = $this->find($id);
        return $record ? $record->update($data) : false;
    }


    public function delete(int $id): bool
    {
        $record = $this->find($id);
        return $record ? $record->delete() : false;
    }
}*/






namespace App\Repositories;

use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $app;
    protected $model;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    abstract public function model();

    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    public function paginate($perPage = 15, $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    // Optionally, you can add other common Eloquent methods here:
    public function create(array $input)
    {
        return $this->model->create($input);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function all($columns = ['*'])
    {
        return $this->model->get($columns);
    }

    public function update(array $input, $id)
    {
        $record = $this->find($id);
        $record->update($input);
        return $record;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
