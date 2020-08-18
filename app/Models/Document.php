<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public function country()
    {
    return $this->belongsTo(Country::class);
    }
    public function doctype()
    {
    return $this->belongsTo(DocType::class);
    }
}
