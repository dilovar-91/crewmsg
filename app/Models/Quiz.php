<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    
    public function interview()
    {
    return $this->belongsTo(Interview::class);
    }

    public function setAnswersAttribute($answers)
    {
        
        
        if (is_array($answers)) {
            $this->attributes['answers'] = json_encode($answers);
        }
        
    }

    


    public function getAnswersAttribute($answers)
    {
        return json_decode($answers, true);
    }
}
