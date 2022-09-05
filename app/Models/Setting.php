<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['title' , 'value'];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
    public function firstPhotos()
    {
        return $this->hasOne(Photo::class);
    }
}
