<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = ['customer_id', 'service_id', 'units', 'charged', 'status'];

    // Каждый заказ принадлежит одному клиенту
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Каждый заказ принадлежит одной услуге
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}