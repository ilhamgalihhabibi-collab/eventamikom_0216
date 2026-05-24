<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'title', 'slug', 'organizer',
        'event_date', 'event_time', 'location',
        'description', 'price', 'stock', 'poster_path'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}