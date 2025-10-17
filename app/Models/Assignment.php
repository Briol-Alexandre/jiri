<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Assignment extends Model
{
    use HasFactory;

    function contacts():BelongsToMany
    {
        return $this->belongsToMany(Contact::class, 'implementations');
    }

    function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    function jiri(): BelongsTo
    {
        return $this->belongsTo(Jiri::class);
    }
}
