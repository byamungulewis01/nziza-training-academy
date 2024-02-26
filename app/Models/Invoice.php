<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'branch',
        'invoice_no',
        'salesperson',
        'address',
        'valid_date',
        'expired_date',
        'training',
        'training_qty',
        'training_discount',
        'licence',
        'total',
        'licence_qty',
        'licence_discount',
        'notes',
    ];
}
