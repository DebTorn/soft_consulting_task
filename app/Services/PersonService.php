<?php

namespace App\Services;

use App\Repositories\PersonRepository;
use App\Services\Interfaces\PersonServiceInt;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PersonService implements PersonServiceInt{

    public function __construct(
        private PersonRepository $personRepository,
        private LogService $logService
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

    public function edit($data){
        $person = $this->personRepository->getById($data['id']);

        if(!$person){
            throw new HttpException(404, 'A személy nem található');
        }

        unset($data['id']);

        if(!$this->personRepository->update($person, $data)){
            throw new HttpException(400, 'A személy módosítása nem sikerült');
        }

        throw new HttpException(200, 'A személy módosítása sikeresen megtörtént');
    }

    public function insert($data){
        if(!$this->personRepository->save($data)){
            throw new HttpException(400, 'A személy mentése sikertelen');
        }

        throw new HttpException(200, 'A személy mentése sikeresen megtörtént');
    }

    public function delete($id){
        if (empty($id)) {
            throw new HttpException(400, 'Az azonosító megadása kötelező');
        }

        $person = $this->personRepository->getById($id);

        if(empty($person)){
            throw new HttpException(404, 'A keresett személy nem található');
        }

        if(!$this->personRepository->delete($person)){
            throw new HttpException(400, 'A személy törlése sikertelen');
        }

        throw new HttpException(200, 'A személy törlése sikeresen megtörtént');
    }

}