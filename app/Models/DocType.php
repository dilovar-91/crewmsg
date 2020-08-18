<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocType extends Model
{
    public function document()
    {
    return $this->hasMany(Document::class);
    }
}
