<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemoApproval extends Model
{
    protected $fillable = ['project_request_id', 'demo_url', 'status', 'client_feedback', 'approved_at'];

    protected $casts = ['approved_at' => 'datetime'];

    public function projectRequest()
    {
        return $this->belongsTo(ProjectRequest::class);
    }
}
