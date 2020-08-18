<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    public function interview()
    {
        return $this->belongsTo(Interview::class);
    }
    public function invite()
    {
        return $this->belongsTo(Invite::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function answer()
    {
        return $this->hasMany(Answer::class);
    }
}
