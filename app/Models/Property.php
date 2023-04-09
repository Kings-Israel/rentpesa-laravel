<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Property extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
      'agreement_start_date' => 'date',
      'agreement_end_date' => 'date',
      'is_active' => 'boolean'
    ];

    public function user(): BelongsTo
    {
      return $this->belongsTo(User::class);
    }
}
