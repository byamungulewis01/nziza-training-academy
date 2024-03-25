<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyGoalsList extends Model
{
    use HasFactory;
    protected $fillable = [
        'monthly_goal_id',
        'type',
        'quality',
        'revenue',
        'achieves_revenue',
        'client_name',
        'description',
    ];

    public static function boot()
    {
        parent::boot();

        self::created(function ($monthlyGoalsList) {
            $monthlyGoalsList->updateMonthlyGoalTotalEstimateRevenues();
        });

        self::updated(function ($monthlyGoalsList) {
            $monthlyGoalsList->updateMonthlyGoalTotalEstimateRevenues();
        });

        self::deleted(function ($monthlyGoalsList) {
            $monthlyGoalsList->updateMonthlyGoalTotalEstimateRevenues();
        });
    }

    public function monthly_goal()
    {
        return $this->belongsTo(MonthlyGoal::class);
    }

    protected function updateMonthlyGoalTotalEstimateRevenues()
    {
        $totalRevenue = MonthlyGoalsList::where('monthly_goal_id', $this->monthly_goal_id)->sum('revenue');
        $totalAchieves = MonthlyGoalsList::where('monthly_goal_id', $this->monthly_goal_id)->sum('achieves_revenue');

        $this->monthly_goal->update([
            'total_estimate_revenues' => $totalRevenue,
            'total_achieves_revenues' => $totalAchieves,
        ]);
    }

}
