<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DairlyReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'beforenoon',
        'afternoon',
        'reported_by',
        'comment',
        'commented_at',
        'commented_by',
    ];
}
