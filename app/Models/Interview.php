<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    public function invite()
    {
    return $this->belongsTo(Invite::class);
    }
    public function user()
    {
    return $this->belongsTo(User::class);
    }

    public function questions()
    {
    return $this->hasMany(Question::class);
    }
    public function feedback()
    {
    return $this->hasOne(Feedback::class);
    }

    public function quizzes()
    {
    return $this->hasMany(Quiz::class);
    }
}
