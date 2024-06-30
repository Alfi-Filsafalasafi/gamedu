<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogSubBabUser extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'log_sub_bab_users';

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function bab()
    {
        return $this->belongsTo(Bab::class, 'id_bab');
    }

    public function subBab() {
        return $this->belongsTo(SubBab::class, 'id_sub_bab');
    }
}
