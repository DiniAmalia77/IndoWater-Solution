<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Device extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'property_id',
        'device_number',
        'device_type',
        'brand',
        'model',
        'serial_number',
        'installation_date',
        'last_maintenance_date',
        'status',
        'health_score',
        'metadata',
    ];

    protected $casts = [
        'installation_date' => 'date',
        'last_maintenance_date' => 'date',
        'health_score' => 'decimal:2',
        'metadata' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
            if (empty($model->device_number)) {
                $model->device_number = 'DEV-' . strtoupper(Str::random(10));
            }
        });
    }

    public $incrementing = true;
    protected $keyType = 'int';

    // Relationships
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function waterUsages()
    {
        return $this->hasMany(WaterUsage::class);
    }

    public function iotDevice()
    {
        return $this->hasOne(IoTDevice::class);
    }

    public function maintenanceSchedules()
    {
        return $this->hasMany(MaintenanceSchedule::class);
    }

    public function workOrders()
    {
        return $this->hasMany(WorkOrder::class);
    }

    public function leakDetectionEvents()
    {
        return $this->hasMany(LeakDetectionEvent::class);
    }

    public function tamperingEvents()
    {
        return $this->hasMany(DeviceTamperingEvent::class);
    }
}
