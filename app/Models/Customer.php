<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'phone', 'address'];

    // Один клиент может иметь много заказов (билетов)
    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}