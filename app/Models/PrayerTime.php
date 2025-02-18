<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrayerTime extends Model {
    use HasFactory;

    protected $fillable = ['city', 'date', 'sehri_time', 'iftar_time'];
}
