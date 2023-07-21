<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HourlyRate extends Model
{
    use HasFactory;

    protected $table = 'hourly_rates';

    protected $fillable = [
        'id',
        'employee_id',
        'price'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
