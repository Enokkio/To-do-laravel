<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class priority extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'deadline',
        'user_id',
        'priority_id',
        'details',

    ];
    public function priority(){
        return $this->belongsTo(todo::class);
    }
}
