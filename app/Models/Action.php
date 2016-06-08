<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'currency', 'has_action', 'action',
  ];

  public function scopeCurrency($query, $currencyName = null)
  {
      $query->where('currency', $currencyName ?: $this->currency);
  }
}
