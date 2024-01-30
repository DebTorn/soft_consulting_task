<?php

namespace App\Repositories;

use App\Models\Person;
use App\Repositories\Interfaces\PersonRepositoryInt;
use Exception;

class PersonRepository implements PersonRepositoryInt{

    public function getAll(){
        return Person::all();
    }

    public function getById($id){
        if(empty($id)){
            throw new Exception('A bemeneti adatok nem megfelelőek');
        }

        $person = Person::find($id);

        return $person;
    }

    public function save(array $datas){
        if(empty($datas)){
            throw new Exception('A bemeneti adatok nem megfelelőek');
        }

        return Person::create($datas);
    }

    public function update(Person $person, array $datas){
        if(empty($person) || empty($datas)){
            throw new Exception('A bemeneti adatok nem megfelelőek');
        }

        return $person->update($datas);
    }

    public function delete(Person $person){
        if(empty($person)){
            throw new Exception('A bemeneti adatok nem megfelelőek');
        }

        return $person->delete();
    }

}