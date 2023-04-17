<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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

  /**
   * Get all of the users for the Unit
   */
  public function users(): HasManyThrough
  {
    return $this->hasManyThrough(User::class, UserUnit::class);
  }

  public function isOccuppied()
  {
    $exists = UserUnit::where('unit_id', $this->id)->where('is_active', true)->first();

    if ($exists) {
      return true;
    }

    return false;
  }

  public function currentTenant()
  {
    $unit = UserUnit::with('user')->where('unit_id', $this->id)->where('is_active', true)->latest()->first();

    return $unit;
  }
}
