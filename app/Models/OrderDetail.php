<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Support\Str;

class OrderDetail extends Model implements Auditable
{
    use HasFactory, AuditableTrait, HasUuids;

    protected $table = 'order_details';

    protected $fillable = ["order_id", "name", "qty", "price", "original_price"];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });
    }
    public function totalRealPrice()
    {
        return $this->original_price * $this->qty;
    }
    public function totalPrice()
    {
        return $this->price * $this->qty;
    }
    public function totalKeuntungan()
    {
        return $this->totalPrice() - $this->totalRealPrice();
    }
}
