<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class TipEngagement extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'tip_id',
        'customer_id',
        'engagement_type',
        'engaged_at',
    ];

    protected $casts = [
        'engaged_at' => 'datetime',
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
    public function tip()
    {
        return $this->belongsTo(WaterConservationTip::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
