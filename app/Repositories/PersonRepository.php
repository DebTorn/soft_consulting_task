<?php

namespace App\Repositories;

use App\Exceptions\PersonException;
use App\Models\Person;
use App\Repositories\Interfaces\PersonRepositoryInt;
use Exception;

class PersonRepository implements PersonRepositoryInt{

    public function getAll(){
        return Person::all();
    }

    public function getById($id){
        if(empty($id)){
            throw new PersonException('A bemeneti adatok nem megfelelőek', 1);
        }

        $person = Person::find($id);

        return $person;
    }

    public function save(array $datas){
        if($this->exist($datas)){
            return null;
        }

        return Person::create($datas);
    }

    public function exist(array $datas)
    {
        $person = Person::where('id', $datas['id'])->exists();

        if($person){
            return 2;
        }else{
            $person = Person::where('email', $datas['email'])->exists();

            if($person){
                return 3;
            }else{

                $person = Person::where('adoazonositojel', $datas['adoazonositojel'])->exists();

                if($person){
                    return 4;
                }

            }
        }

        return false;
    }

}