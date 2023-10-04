<?php

namespace App\Models;

use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'unit_price',
        'author_name'
    ]; 
    public function orderdetails() {
        return $this->hasMany(OrderDetail::class, 'book_id');
    }
}
