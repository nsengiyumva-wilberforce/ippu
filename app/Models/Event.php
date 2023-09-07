<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory,softDeletes;

    /**
     * Event has one Attended.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function attended()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = event_id, localKey = id)
        return $this->hasOne(Attendence::class)->where('user_id',\Auth::user()->id);
    }

        /**
     * Event has one Attended for mobile app(API)
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function attendedEvents()
    {
        return $this->hasMany(Attendence::class, 'event_id');
    }


    /**
     * Event has many Attendences.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attendences()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = event_id, localKey = id)
        return $this->hasMany(Attendence::class);
    }

    /**
     * Event has many Pending_confimation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pending_confimation()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = event_id, localKey = id)
        return $this->hasMany(Attendence::class)->where('status','Pending');
    }

    public function confirmed()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = event_id, localKey = id)
        return $this->hasMany(Attendence::class)->where('status','Confirmed');
    }

    public function attended_event()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = event_id, localKey = id)
        return $this->hasMany(Attendence::class)->where('status','Attended');
    }
}
