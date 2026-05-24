<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'order_id', 'event_id', 'customer_name', 'customer_email',
        'customer_phone', 'qty', 'total_price', 'payment_status'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}