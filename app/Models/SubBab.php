<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBab extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function bab()
    {
        return $this->belongsTo(Bab::class, 'id_bab');
    }

    public function logSubBabUsers()
    {
        return $this->hasMany(LogSubBabUser::class, 'id_sub_bab', 'id');
    }
}
