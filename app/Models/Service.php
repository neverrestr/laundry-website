<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'price_per_unit', 'unit'];

    // Одна услуга может быть во многих заказах
    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}