<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Implementation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'contact_id',
        'assignment_id',
    ];
    
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
    
    public function assignment(): BelongsTo
    {
        return $this->belongsTo(Assignment::class);
    }
}
