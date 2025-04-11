<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'price', 'description', 'image', 'max_entries', 'is_active'];
    public function participations()
    {
        return $this->hasMany(Participation::class);
    }
}
