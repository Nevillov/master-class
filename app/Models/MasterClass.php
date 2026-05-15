<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterClass extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'date',
        'time',
        'max_people',
        'price'
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }
}