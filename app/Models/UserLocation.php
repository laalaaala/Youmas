<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'street_number',
        'zip_code',
        'city',
        'formatted_address',
        'lat',
        'lng',
        'user_id'
    ];

    /**
     * Radio around location function
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Radio around location function
     */

    public function scopeIsWithinMaxDistance($query, $coordinates, $radius = 5)
    {

        $haversine = "(6371 * acos(cos(radians(" . $coordinates['latitude'] . ")) 
                        * cos(radians(`lat`)) 
                        * cos(radians(`lng`) 
                        - radians(" . $coordinates['longitude'] . ")) 
                        + sin(radians(" . $coordinates['latitude'] . ")) 
                        * sin(radians(`lat`))))";

        return $query->selectRaw("{$haversine} AS distance")
            ->whereRaw("{$haversine} < ?", [$radius]);
    }
}
