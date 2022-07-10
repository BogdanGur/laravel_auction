<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    use HasFactory;

    public function image() {
        return $this->hasOne(Image::class);
    }

    public function images() {
        return $this->hasMany(Image::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function last_bet() {
        return $this->hasOne(Bet::class)->orderBy('created_at', 'desc');
    }
}
