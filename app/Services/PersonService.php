<?php

namespace App\Services;

use App\Exceptions\PersonException;
use App\Repositories\PersonRepository;
use App\Services\Interfaces\PersonServiceInt;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PersonService implements PersonServiceInt{

    public function __construct(
        private PersonRepository $personRepository
    )
    {}

    public function getAll(){
        $persons = $this->personRepository->getAll();

        return $persons;
    }

    public function getById($id){
        if (empty($id)) {
            throw new HttpException(404, 'Nem adott meg azonosítót');
        }

        $person = $this->personRepository->getById($id);

        if (empty($person)) {
            throw new HttpException(404, 'A keresett személy nem található');
        }

        return $person;
    }

    public function insert($data){

        if(empty($data)){
            throw new PersonException('Nem adott át adatokat');
        }

        if($this->personRepository->exist($data)){
            throw new PersonException('A személy már importálva lett');
        }

        $person = $this->personRepository->save($data);

        if(empty($person)){
            throw new PersonException('A személy mentése sikertelen');
        }

        return $person;
    }

}