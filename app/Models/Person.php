<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{

    protected $table = "persons";

    protected $fillable = [
        'id',
        'azonosito',
        'adoazonositojel',
        'teljesnev',
        'egyebid',
        'belepes',
        'kilepes',
        'email'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function logs(){
        return $this->hasMany(Log::class);
    }

    use HasFactory;
}
