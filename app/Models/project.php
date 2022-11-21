<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'creator_user_id',
        

    ];
    public function todos(){
        return $this->hasMany(todo::class);
    }
    
    public function users(){
        return $this->hasMany(User::class);
    }
}
