<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    public function investments(){
        return $this->hasMany(Investment::class);
    }
}
