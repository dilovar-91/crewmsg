<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    public $timestamps = true;
    public function interview()
    {
    return $this->belongsTo(Interview::class);
    }
    
    public function invite()
    {
    return $this->belongsTo(Invite::class);
    }

    public function answer()
    {
    return $this->hasMany(Answer::class);
    }
    public function user()
    {
    return $this->belongsTo(Answer::class);
    }
}
