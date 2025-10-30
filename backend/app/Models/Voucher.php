<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Voucher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'code',
        'name',
        'description',
        'discount_type',
        'discount_value',
        'max_discount',
        'min_purchase',
        'usage_limit',
        'used_count',
        'valid_from',
        'valid_until',
        'status',
        'metadata',
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'max_discount' => 'decimal:2',
        'min_purchase' => 'decimal:2',
        'used_count' => 'integer',
        'usage_limit' => 'integer',
        'valid_from' => 'datetime',
        'valid_until' => 'datetime',
        'metadata' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    public $incrementing = true;
    protected $keyType = 'int';

    // Relationships
    public function usages()
    {
        return $this->hasMany(VoucherUsage::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Helper methods
    public function isValid()
    {
        return $this->status === 'active' 
            && now()->between($this->valid_from, $this->valid_until)
            && ($this->usage_limit === null || $this->used_count < $this->usage_limit);
    }
}
