<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'visitors';
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
