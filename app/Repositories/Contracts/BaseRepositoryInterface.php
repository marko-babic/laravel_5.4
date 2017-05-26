<?php

namespace L2\Repositories\Contracts;


interface BaseRepositoryInterface
{
    public function getById($id);

    public function getAll();
}