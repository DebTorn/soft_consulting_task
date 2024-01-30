<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{

    protected $table = "persons";

    public function logs(){
        return $this->hasMany(Log::class);
    }

    use SoftDeletes;
    use HasFactory;
}
