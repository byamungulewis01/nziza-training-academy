<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demostration extends Model
{
    use HasFactory;
    protected $fillable = [
        'topic',
        'phone',
        'email',
        'company_name',
        'suggest_date',
        'comments',
    ];
}
