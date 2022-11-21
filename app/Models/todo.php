<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todo extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function project(){
        return $this->belongsTo(project::class);
    }
    

    protected $fillable = [
        'title',
        'deadline',
        'user_id',
        'priority_id',
        'details',
        'project_id',

    ];
    use HasFactory;
            // $table->id();
            // $table->string('title');
            // $table->string('details');
            // $table->date('deadline');
            // $table->unsignedBigInteger('priority_id');
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('priority_id')->references('id')->on('priorities');
            // $table->timestamps();
 
    public function priority(){
        return $this->hasOne(priority::class);
    }
  
}
