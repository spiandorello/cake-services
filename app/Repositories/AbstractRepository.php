<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class AbstractRepository
{
    protected Model $model;

    public function __construct(
       string $model
    ) {
        $this->model = $this->resolveModel($model);
    }

    private function resolveModel(string $model): Model
    {
        return app($model);
    }

    private function getModel(): Model
    {
        return $this->model;
    }

    public function find(string $id)
    {
        return $this->getModel()::find($id);
    }

    public function findBy(array $params)
    {
        return $this->getModel()::where($params)
            ->first();
    }

    public function create(array $params)
    {
        return $this->getModel()::create($params);
    }

    public function flush(Model $model): ?bool
    {
        return $model->save();
    }

    public function delete(Model $model): ?bool
    {
        return $model->delete();
    }
}
