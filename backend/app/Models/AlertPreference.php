<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class AlertPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'customer_id',
        'alert_type',
        'is_enabled',
        'notify_email',
        'notify_sms',
        'notify_push',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'notify_email' => 'boolean',
        'notify_sms' => 'boolean',
        'notify_push' => 'boolean',
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
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
