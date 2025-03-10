<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ciutat extends Model
{
    use HasFactory;
    protected $fillable = ["nom"];
    public function pais(): BelongsTo
    {
        return $this->belongsTo(Ciutat::class);
    }

}
