<?php

namespace App\Repositories\Interfaces;

use App\Models\Person;

interface PersonRepositoryInt{
    public function getAll();

    public function getById($id);

    public function save(array $datas);

    public function update(Person $person, array $datas);

    public function delete(Person $person);
}