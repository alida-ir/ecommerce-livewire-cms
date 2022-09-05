<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    use HasFactory , SoftDeletes;
//    protected $casts = ['deleted_at'] ;
    protected $guarded ;

    public function ForceStoreDelete()
    {
       dd(1);

    }
}
