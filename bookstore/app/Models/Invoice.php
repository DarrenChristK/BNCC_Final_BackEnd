<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['user_id', 'total_price'];

    public function items()
    {
        return $this->hasMany(\App\Models\InvoiceItem::class);
    }

}
