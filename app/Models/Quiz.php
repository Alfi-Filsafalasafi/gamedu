<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'quizs';
    public function bab()
    {
        return $this->belongsTo(Bab::class, 'id_bab');
    }
    public function subQuizs()
    {
        return $this->hasMany(SubQuiz::class, 'id_quiz');
    }
}
