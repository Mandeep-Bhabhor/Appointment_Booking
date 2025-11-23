<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //
    protected $fillable = [
        'user_id',
        'phone',
        'reason',
        'status',
        'appointment_date',
    ];  


    public function user()
{
    return $this->belongsTo(User::class);
}

}
