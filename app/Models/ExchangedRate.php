<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExchangedRate extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'source', 'rate',
  ];

  public function scopeRate($query, $rateName = null)
  {
      $query->where('name', $rateName ?: $this->name);
  }

  public function scopeRateBySource($query, $sourceName= null, $rateName = null)
  {
      $query->where('name', $rateName ?: $this->name)
            ->where('source', $sourceName ?: $this->source);
  }

  public function scopeRatesBySource($query, $sourceName= null)
  {
      $query->where('source', $sourceName ?: $this->source);
  }
}
