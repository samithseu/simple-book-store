<?php

namespace App\Models;

use App\Models\Book;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'orderdetails';
    protected $primaryKey = 'id';
    protected $fillable = [
        'book_id',
        'order_id',
        'qty'
    ];
    
    public function book() {
        return $this->belongsTo(Book::class, 'book_id');
    }
    public function order() {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
