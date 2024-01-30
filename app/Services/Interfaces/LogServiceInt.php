<?php

namespace App\Services\Interfaces;

interface LogServiceInt{
    public function getAll();

    public function getById($id);

    public function insert($data);
}