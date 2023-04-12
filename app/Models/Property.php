<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
      'is_active' => 'boolean'
    ];

    public function user(): BelongsTo
    {
      return $this->belongsTo(User::class);
    }

    public function county(): BelongsTo
    {
      return $this->belongsTo(County::class);
    }

    public function subcounty(): BelongsTo
    {
      return $this->belongsTo(Subcounty::class);
    }

    /**
     * Get all of the units for the Property
     */
    public function units(): HasMany
    {
      return $this->hasMany(Unit::class);
    }
}
