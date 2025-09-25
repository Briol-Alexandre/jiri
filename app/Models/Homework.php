<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Homework extends Model
{
    use HasFactory;
    protected $table = 'homeworks';

    function contacts():BelongsToMany
    {
        return $this->belongsToMany(Contact::class, 'implementations');
    }
}
