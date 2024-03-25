<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyGoal extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'month',
        'total_estimate_revenues',
        'total_achieves_revenues',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
