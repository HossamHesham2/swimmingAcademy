<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['member_id', 'price', 'start_date', 'end_date'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
