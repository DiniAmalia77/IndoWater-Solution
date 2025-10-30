<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class TicketAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'ticket_id',
        'file_name',
        'file_path',
        'file_size',
        'mime_type',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'file_size' => 'integer',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
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
    public function ticket()
    {
        return $this->belongsTo(SupportTicket::class);
    }
}
