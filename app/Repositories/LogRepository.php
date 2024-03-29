<?php

namespace App\Repositories;

use App\Models\Log;
use App\Repositories\Interfaces\LogRepositoryInt;
use Exception;

class LogRepository implements LogRepositoryInt{

    public function getAll(){
        return Log::all();
    }

    public function getById($id, $with = []){
        $log = null;

        if(is_array($with) && count($with) > 0){
            $log = Log::with($with)->find($id);
        }else{
            $log = Log::find($id);
        }

        return $log;
    }

    public function save(array $datas){
        return Log::create($datas);
    }

}