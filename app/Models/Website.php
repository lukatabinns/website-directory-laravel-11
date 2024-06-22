<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'title', 'description'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
