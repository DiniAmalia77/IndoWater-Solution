<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class DeviceTamperingEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'device_id',
        'detected_at',
        'tampering_type',
        'description',
        'is_resolved',
        'resolved_at',
        'metadata',
    ];

    protected $casts = [
        'detected_at' => 'datetime',
        'is_resolved' => 'boolean',
        'resolved_at' => 'datetime',
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
    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
