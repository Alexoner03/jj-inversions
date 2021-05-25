<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $guarded =[];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'ended_at' => 'datetime:Y-m-d',
    ];
    
    public function investor(){
        return $this->belongsTo(Investor::class);
    }

    public function state(){
        return $this->belongsTo(InvestmentState::class,'investment_state_id','id');
    }

}
