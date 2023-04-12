<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Unit extends Model
{
  use HasFactory;

  protected $guarded = [];

  /**
   * Get the property that owns the Unit
   */
  public function property(): BelongsTo
  {
    return $this->belongsTo(Property::class);
  }
}
