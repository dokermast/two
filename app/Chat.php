<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
