<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  use HasFactory;
  protected $fillable = [
    'order_no',
    'user_id',
    'product_id',
    'unit',
    'price',
    'payment_method',
    'permission',
    'status',
    'order_status',
    'order_qty_status'
  ];
  public function user()
  {
    return $this->belongsTo(User::class);
  }
  public function product()
  {
    return $this->belongsTo(Product::class, 'product_id');
  }
}
