<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = ['invoice_id', 'book_id', 'quantity', 'subtotal'];

    public function book()
    {
        return $this->belongsTo(\App\Models\Book::class);
    }

}
