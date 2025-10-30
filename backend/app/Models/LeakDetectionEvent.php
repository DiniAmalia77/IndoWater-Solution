<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class LeakDetectionEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'device_id',
        'detected_at',
        'leak_severity',
        'estimated_loss',
        'is_resolved',
        'resolved_at',
        'metadata',
    ];

    protected $casts = [
        'detected_at' => 'datetime',
        'estimated_loss' => 'decimal:3',
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
