<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class TicketMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'ticket_id',
        'user_id',
        'message',
        'is_internal',
    ];

    protected $casts = [
        'is_internal' => 'boolean',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
