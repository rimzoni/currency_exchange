<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Surcharge;

class Order extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'exchanged_currency', 'exchanged_rate', 'surcharge_percentage',
      'purchased_amount','paid_amount','surcharge_amount', 'total_amount',
      'discount_amount','discount_percentage','status',
  ];

  protected $primaryKey = "id";
}
