<?php

namespace App\Repositories\Interfaces;

interface LogRepositoryInt{
    public function getAll();

    public function getById($id, $with = []);

    public function save(array $datas);
}