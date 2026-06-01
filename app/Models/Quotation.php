<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = ['project_request_id', 'quote_number', 'line_items', 'subtotal', 'tax', 'total', 'status', 'valid_until'];

    protected $casts = [
        'line_items' => 'array',
        'valid_until' => 'date',
    ];

    public function projectRequest()
    {
        return $this->belongsTo(ProjectRequest::class);
    }
}
