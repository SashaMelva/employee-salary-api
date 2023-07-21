<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusTransaction extends Model
{
    use HasFactory;

    protected $table = 'status_transactions';

    protected $fillable = [
        'id',
        'title',
        'description'
    ];

    public function transactions()
    {
        return $this->hasMany(Transactions::class);
    }
}
