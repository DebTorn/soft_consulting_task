<?php

namespace App\Services\Interfaces;

interface PersonServiceInt{
    public function getAll();

    public function getById($id);

    public function edit($data);

    public function insert($data);

    public function delete($id);
}