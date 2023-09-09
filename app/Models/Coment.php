<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coment extends Model
{
    use HasFactory;

    protected $table = 'coment';
    protected $guarded = ['id'];

    function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    function forum()
    {
        return $this->belongsTo(Forum::class, 'forum_id', 'id');
    }
}
