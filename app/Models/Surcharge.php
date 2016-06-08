<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surcharge extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'currency', 'percentage',
  ];

  public function scopeCurrency($query, $currencyName = null)
  {
      $query->where('currency', $currencyName ?: $this->currency);
  }
}
