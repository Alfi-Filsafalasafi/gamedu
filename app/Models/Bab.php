<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bab extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subBabs()
    {
        return $this->hasMany(SubBab::class, 'id_bab');
    }
}
