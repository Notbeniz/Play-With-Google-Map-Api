<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable = ['address', 'lat', 'long'];

    public function scopeFetPoints($query)
    {
        return $query->all();
    }
}
