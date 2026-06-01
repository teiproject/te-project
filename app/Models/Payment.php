<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['project_request_id', 'invoice_id', 'provider', 'provider_order_id', 'provider_payment_id', 'amount', 'currency', 'status', 'metadata'];

    protected $casts = ['metadata' => 'array'];

    public function projectRequest()
    {
        return $this->belongsTo(ProjectRequest::class);
    }
}
