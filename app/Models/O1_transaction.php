<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class O1_transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'b_masters_id',
    ];

    public function b_masters()
    {
        return $this->belongsTo('App\Models\B_master');
    }
}
