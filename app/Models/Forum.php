<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $table = 'forum';
    protected $guarded = ['id'];


    function komentar()
    {
        return $this->hasMany(Coment::class, 'forum_id', 'id');
    }
    function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
