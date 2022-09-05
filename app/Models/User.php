<?php

namespace App\Models;

use App\Events\UserRegistered;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use  HasFactory, Notifiable , SoftDeletes;


    protected $fillable = [
        'name',
        'number',
        'email',
        'password',
        'role_id',
        'approved' ,
        'approved_code' ,
        'approved_expired'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function newUser($request)
    {
        return static::create([
            'name' => $request->names,
            'number' => $request->number,
            'email' => $request->email,
            'role_id' => Role::ROLE_USER_ID,
            'approved_code' => rand(12345 , 99999),
            'approved_expired' => Carbon::now()->addMinutes(2),
            'password' => Hash::make($request->password),
        ]);
    }

    public function HasUser()
    {
        return $this->role()->where('title' , 'normal-user')->exists();
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function newApproverUpdate()
    {
        return $this->update([
            'approved' => true ,
            'approved_code' => null ,
            'approved_expired' => null
        ]);
    }

    public function generateCode()
    {
        return $this->update([
            'approved_code' => rand(12345 , 99999),
            'approved_expired' => Carbon::now()->addMinutes(2),
        ]);
    }

    public function updateUser($data)
    {
        return $this->update($data);
    }

    public function role()
    {
        return $this->hasOne(Role::class , 'id' , 'role_id');
    }

    public function transActions()
    {
        return $this->hasMany(TransAction::class);
    }

    public function getPermissions()
    {
        return $this->role->permissions;
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class);
    }

}
