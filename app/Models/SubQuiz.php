<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubQuiz extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'sub_quizs';
    
    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'id_quiz');
    }
}
