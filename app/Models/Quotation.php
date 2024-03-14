<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'company_name',
        'position',
        'training',
        'training_qty',
        'licence',
        'licence_qty',
        'comments',
    ];

}
