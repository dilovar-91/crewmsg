<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    public function user()
    {
    return $this->belongsTo(User::class, 'seamen_id');
    }
    public function inviter()
    {
    return $this->belongsTo(User::class, 'invited_by_id');
    }
    public function interview()
    {
    return $this->hasOne(Interview::class);
    }
    public function feedback()
    {
    return $this->hasMany(Feedback::class);
    }
    public function question()
    {
    return $this->hasMany(Question::class, 'seamen_id');
    }
    public function quiz_result()
    {
    return $this->hasMany(QuizResult::class, 'seamen_id');
    }
}
