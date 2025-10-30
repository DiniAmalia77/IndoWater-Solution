<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class IoTReading extends Model
{
    use HasFactory;

    protected $table = 'iot_readings';

    protected $fillable = [
        'uuid',
        'iot_device_id',
        'reading_type',
        'value',
        'unit',
        'timestamp',
        'metadata',
    ];

    protected $casts = [
        'value' => 'decimal:3',
        'timestamp' => 'datetime',
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
    public function iotDevice()
    {
        return $this->belongsTo(IoTDevice::class);
    }
}
