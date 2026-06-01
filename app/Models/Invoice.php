<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['project_request_id', 'quotation_id', 'invoice_number', 'amount', 'advance_amount', 'status', 'due_date'];

    protected $casts = ['due_date' => 'date'];

    public function projectRequest()
    {
        return $this->belongsTo(ProjectRequest::class);
    }

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }
}
