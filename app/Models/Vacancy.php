<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    public function interview()
    {
        return $this->hasMany(Interview::class);
    }
}
