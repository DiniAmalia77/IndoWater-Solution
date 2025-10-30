<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'customer_id',
        'reference_number',
        'payment_method',
        'payment_gateway',
        'amount',
        'admin_fee',
        'total_amount',
        'status',
        'payment_date',
        'voucher_id',
        'voucher_discount',
        'gateway_response',
        'metadata',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'admin_fee' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'voucher_discount' => 'decimal:2',
        'payment_date' => 'datetime',
        'gateway_response' => 'array',
        'metadata' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
            if (empty($model->reference_number)) {
                $model->reference_number = 'PAY-' . strtoupper(Str::random(12));
            }
        });
    }

    public $incrementing = true;
    protected $keyType = 'int';

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}
