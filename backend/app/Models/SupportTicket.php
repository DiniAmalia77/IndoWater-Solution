<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class SupportTicket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'ticket_number',
        'customer_id',
        'user_id',
        'assigned_to',
        'subject',
        'description',
        'category',
        'priority',
        'status',
        'resolved_at',
        'metadata',
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
        'metadata' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
            if (empty($model->ticket_number)) {
                $model->ticket_number = 'TKT-' . strtoupper(Str::random(8));
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function messages()
    {
        return $this->hasMany(TicketMessage::class, 'ticket_id');
    }

    public function attachments()
    {
        return $this->hasMany(TicketAttachment::class, 'ticket_id');
    }
}
