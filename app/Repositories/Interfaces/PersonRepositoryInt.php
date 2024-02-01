<?php

namespace App\Repositories\Interfaces;

use App\Models\Person;

interface PersonRepositoryInt{
    public function getAll();

    public function getById($id);

    public function exist(array $datas);

    public function save(array $datas);
}