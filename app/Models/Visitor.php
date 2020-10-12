<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'venue_id',
        'email',
        'phone',
        'postcode',
        'extra_guests',
    ];

    public function scopeToday($query)
    {
        return $query->where('created_at', Carbon::today());
    }

    public function scopeTodayCount($query)
    {
        return $this->scopeToday($query)->count();
    }

    public function maskedEmail()
    {
        [$first, $last] = explode('@', $this->attributes['email']);
        $first = str_replace(substr($first, '3'), str_repeat('*', strlen($first) - 3), $first);
        $last = explode('.', $last);
        $last_domain = str_replace(substr($last['0'], '1'), str_repeat('*', strlen($last['0']) - 1), $last['0']);

        return $first.'@'.$last_domain.'.'.$last['1'];
    }

    public function maskedPostalCode()
    {
        // TODO mask postcodes
        return $this->attributes['postcode'];
    }
}
