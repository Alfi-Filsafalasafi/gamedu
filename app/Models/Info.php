<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'infos';

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }
}
