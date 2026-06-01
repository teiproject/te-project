<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectRequest extends Model
{
    protected $fillable = [
        'user_id', 'reference', 'client_name', 'email', 'phone', 'company', 'service',
        'platform', 'features', 'timeline_weeks', 'pages', 'base_price', 'estimated_price',
        'budget_range', 'message', 'status', 'demo_submitted_at', 'demo_approved_at',
    ];

    protected $casts = [
        'features' => 'array',
        'demo_submitted_at' => 'datetime',
        'demo_approved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quotation()
    {
        return $this->hasOne(Quotation::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function demoApproval()
    {
        return $this->hasOne(DemoApproval::class);
    }

    public function advanceAmount(): int
    {
        return (int) ceil($this->estimated_price * 0.30);
    }
}
