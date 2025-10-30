<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'customer_id',
        'property_number',
        'property_name',
        'property_type',
        'address',
        'city',
        'province',
        'postal_code',
        'latitude',
        'longitude',
        'area_size',
        'occupants',
        'status',
        'metadata',
    ];

    protected $casts = [
        'latitude' => 'string',
        'longitude' => 'string',
        'area_size' => 'decimal:2',
        'occupants' => 'integer',
        'metadata' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
            if (empty($model->property_number)) {
                $model->property_number = 'PROP-' . strtoupper(Str::random(10));
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

    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    public function maintenanceSchedules()
    {
        return $this->hasMany(MaintenanceSchedule::class);
    }
}
