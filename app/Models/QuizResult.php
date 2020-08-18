<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    public function interview()
    {
    return $this->belongsTo(Interview::class);
    }

    public function invite()
    {
    return $this->belongsTo(Invite::class);
    }


}
