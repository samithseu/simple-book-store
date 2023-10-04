<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = [
        'customer_id',
        'note'
    ];
    public function orderdetails() {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
    public function customer() {
        return $this->belongsTo(Customer::class, ' customer_id');
    }
}
