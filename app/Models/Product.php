<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory , SoftDeletes , Sluggable;
    protected $fillable = ['name' , 'user_id' , 'brand_id' , 'slug' , 'content' , 'keywords' , 'description'];


    public function sluggable(): array
    {
        // TODO: Implement sluggable() method.
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }



    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function activeDiscount()
    {
        return $this->hasMany(Discount::class)
                    ->where('status' , true)
                    ->where('expired' , '>=' , Carbon::now());
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
    public function firstPhotos()
    {
        return $this->hasOne(Photo::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function warehouses()
    {
        return $this->hasMany(Warehouse::class);
    }
    public function activeWarehouses()
    {
        return $this->hasMany(Warehouse::class)
                ->where('available' , true)
                ->where('quantity' , '>' , 0);
    }
    public function availableWarehouse()
    {
        return $this->hasMany(Warehouse::class)
                ->where('available' , true)
                ->where('quantity' , '>' , 0)
                ->exists();
    }

}
