<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'currency','from', 'to', 'subject', 'template',
  ];

  public function scopeCurrency($query, $currencyName = null)
  {
      $query->where('currency', $currencyName ?: $this->currency);
  }
}
