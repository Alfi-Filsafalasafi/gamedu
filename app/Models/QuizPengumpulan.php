<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizPengumpulan extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'quiz_pengumpulans';

    public function subQuiz()
    {
        return $this->belongsTo(SubQuiz::class, 'id_pertanyaan');
    }
}
