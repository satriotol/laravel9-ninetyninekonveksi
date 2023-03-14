<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Support\Str;

class Order extends Model implements Auditable
{
    use HasFactory, AuditableTrait, HasUuids;

    protected $table = 'orders';

    protected $fillable = ["user_id", "title", "name", "phone", "start_at", "end_at", "description"];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
    public function totalPrice()
    {
        $totalPrice = 0;
        foreach ($this->order_details as $order_detail) {
            $totalPrice += $order_detail->price * $order_detail->qty;
        }
        return $totalPrice;
    }
    public function totalRealPrice()
    {
        $totalPrice = 0;
        foreach ($this->order_details as $order_detail) {
            $totalPrice += $order_detail->original_price * $order_detail->qty;
        }
        return $totalPrice;
    }
}
