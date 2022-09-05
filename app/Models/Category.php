<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory , SoftDeletes , Sluggable;
    protected $fillable = [
        'title'  , 'label'  , 'slug' ,'status' , 'parent_id'
    ];
    public function sluggable() : array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }
    public function activeDiscount()
    {
        return $this->hasMany(Discount::class)
            ->where('status' , true)
            ->where('expired' , '>=' , Carbon::now());
    }
    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class , 'parent_id');
    }
    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Category::class , 'parent_id' , 'id');
    }
    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function photo()
    {
        return $this->hasOne(Photo::class);
    }
}
