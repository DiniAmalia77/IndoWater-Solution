<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class WaterConservationTip extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'title',
        'content',
        'category',
        'estimated_savings',
        'difficulty_level',
        'is_active',
        'metadata',
    ];

    protected $casts = [
        'estimated_savings' => 'decimal:2',
        'is_active' => 'boolean',
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
    public function engagements()
    {
        return $this->hasMany(TipEngagement::class, 'tip_id');
    }
}
