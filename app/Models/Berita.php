<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'beritas';

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }
}
