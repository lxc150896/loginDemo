<?php

namespace App\Repositories\Eloquents;

abstract class AbstractEloquentRepository
{
    abstract public function model();

    public function find($id)
    {
        return $this->model()
        ->find($id);
    }

    public function update($id, $dataUser)
    {
        $model = $this->model()->findOrFail($id);
        if ($model) {
            return $model->update($dataUser);
        }

        return false;
    }

    public function delete($id)
    {
        $model = $this->model()->findOrFail($id);
        if ($model) {
            return $model->delete();
        }

        return false;
    }
}
