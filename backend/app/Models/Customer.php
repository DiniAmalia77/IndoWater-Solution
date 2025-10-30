<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'user_id',
        'customer_number',
        'full_name',
        'phone',
        'email',
        'address',
        'city',
        'province',
        'postal_code',
        'balance',
        'status',
        'metadata',
    ];

    protected $casts = [
        'balance' => 'decimal:2',
        'metadata' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
            if (empty($model->customer_number)) {
                $model->customer_number = 'CUST-' . strtoupper(Str::random(8));
            }
        });
    }

    public $incrementing = true;
    protected $keyType = 'int';

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function supportTickets()
    {
        return $this->hasMany(SupportTicket::class);
    }

    public function voucherUsages()
    {
        return $this->hasMany(VoucherUsage::class);
    }

    public function alertPreferences()
    {
        return $this->hasMany(AlertPreference::class);
    }
}
