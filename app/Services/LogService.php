<?php

namespace App\Services;

use App\Repositories\LogRepository;
use App\Services\Interfaces\LogServiceInt;
use Symfony\Component\HttpKernel\Exception\HttpException;

class LogService implements LogServiceInt{

    public function __construct(
        private LogRepository $logRepository
    )
    {}

    public function getAll(){
        $logs = $this->logRepository->getAll();

        return $logs;
    }

    public function getById($id){
        if (empty($id)) {
            throw new HttpException(404, 'Nem adott meg azonosítót');
        }

        $log = $this->logRepository->getById($id);

        if(empty($log)){
            throw new HttpException(404, 'A keresett log bejegyzés nem található');
        }

        return $log;
    }

    public function insert($data){

        if(empty($data)){
            throw new HttpException(404, 'A bemeneti adatok nem megfelelőek');
        }

        if(!$this->logRepository->save($data)){
            throw new HttpException(400, 'A log bejegyzés mentése sikertelen');
        }

        return true;
    }

}