<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class IoTDevice extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'iot_devices';

    protected $fillable = [
        'uuid',
        'device_id',
        'firmware_version',
        'last_online',
        'connection_status',
        'signal_strength',
        'battery_level',
        'metadata',
    ];

    protected $casts = [
        'last_online' => 'datetime',
        'signal_strength' => 'integer',
        'battery_level' => 'integer',
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

    public function readings()
    {
        return $this->hasMany(IoTReading::class, 'iot_device_id');
    }
}
