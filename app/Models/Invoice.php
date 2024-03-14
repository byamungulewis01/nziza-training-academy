<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'branch',
        'invoice_no',
        'client_id',
        'valid_date',
        'expired_date',
        'status',
        'training',
        'training_qty',
        'training_discount',
        'licence',
        'licence_qty',
        'licence_discount',
        'notes',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
