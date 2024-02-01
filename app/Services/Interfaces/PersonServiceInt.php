<?php

namespace App\Services\Interfaces;

interface PersonServiceInt{
    public function getAll();

    public function getById($id);

    public function insert($data);
}