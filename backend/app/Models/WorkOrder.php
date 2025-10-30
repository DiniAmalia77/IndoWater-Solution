<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class WorkOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'order_number',
        'device_id',
        'technician_id',
        'work_type',
        'description',
        'priority',
        'status',
        'scheduled_date',
        'started_at',
        'completed_at',
        'notes',
        'digital_signature',
        'metadata',
    ];

    protected $casts = [
        'scheduled_date' => 'datetime',
        'started_at' => 'datetime',
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
            if (empty($model->order_number)) {
                $model->order_number = 'WO-' . strtoupper(Str::random(10));
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

    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }
}
