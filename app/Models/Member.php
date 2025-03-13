<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phoneNumber',
        'coachName',
        'level',
        'typeOfTrain',
        'location',
        'state',
    ];
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
