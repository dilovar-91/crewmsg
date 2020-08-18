<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function document()
    {
    return $this->hasMany(Document::class);
    }
    public function service()
    {
    return $this->hasMany(SeaService::class);
    }
}
