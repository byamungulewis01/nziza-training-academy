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
        'trainings',
        'trainee_number',
        'licence',
        'licence_number',
        'comments',
    ];

}
