<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['picUrl'];

    public function bookings() {
        return $this->hasMany(Booking::class, 'room_id');
    }

    public function getPicUrlAttribute() {
        $url = $this->photo ? asset('uploads/photo/' . $this->photo) : "https://lh3.googleusercontent.com/yjDoBdvT5hee7GpGXk5fSi43sU0E_4_f2YeopUW99NJODjcMWAHbDWhkLO6KvjwTXvjQwlyRR0gQx2w2CnGfyohY8ETkGVzVwo-O5ti6uk8gaHecDEMA4w4yyiCAHepf29ZGXE8M";
        return $url;
    }
}
