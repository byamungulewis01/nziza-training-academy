<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseSubscriber extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'description',
        'start_date',
        'end_date',
        'status',
        'contract_file_url',
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
