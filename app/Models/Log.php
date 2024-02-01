<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{

    protected $table = 'logs';

    protected $fillable = [
        'type',
        'datas',
        'reason',
        'person_id'
    ];

    public function person(){
        return $this->belongsTo(Person::class, 'person_id');
    }
    
    use HasFactory;
}
