<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class WaterUsage extends Model
{
    use HasFactory;

    protected $table = 'water_usage';

    protected $fillable = [
        'uuid',
        'device_id',
        'reading_date',
        'current_reading',
        'previous_reading',
        'consumption',
        'cost',
        'status',
        'metadata',
    ];

    protected $casts = [
        'reading_date' => 'datetime',
        'current_reading' => 'decimal:3',
        'previous_reading' => 'decimal:3',
        'consumption' => 'decimal:3',
        'cost' => 'decimal:2',
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
