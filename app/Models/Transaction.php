<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'employee_id',
        'status_id',
        'hours',
        'created_at'
    ];

    public function status()
    {
        return $this->belongsTo(StatusTransaction::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
