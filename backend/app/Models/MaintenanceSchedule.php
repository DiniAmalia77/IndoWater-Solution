<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class MaintenanceSchedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'device_id',
        'property_id',
        'schedule_date',
        'maintenance_type',
        'description',
        'status',
        'completed_at',
        'metadata',
    ];

    protected $casts = [
        'schedule_date' => 'date',
        'completed_at' => 'datetime',
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

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
