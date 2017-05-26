<?php

namespace L2\Repositories;


use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use L2\Repositories\Contracts\BaseRepositoryInterface;
use League\Flysystem\Exception;

abstract class Repository implements BaseRepositoryInterface
{
    private $app;

    protected $model;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    abstract function model();

    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if(!$model instanceof Model) {
            throw new Exception('lol');
        }

        return $this->model = $model;
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function update($array)
    {
        return $this->model->update($array);
    }

    public function create($array)
    {
        return $this->model->create($array);
    }
}