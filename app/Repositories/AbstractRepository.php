<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
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

    public function all(): Collection
    {
        return $this->model->all();
    }
}