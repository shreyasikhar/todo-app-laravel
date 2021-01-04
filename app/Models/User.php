<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function uploadAvatar($image) {
        $filename = $image->getClientOriginalName();
        (new self())->deleteOldImage();
        $image->storeAs('images', $filename, 'public');
        Auth::user()->avatar = $filename;
        Auth::user()->save();
    }

    protected function deleteOldImage() {
        if(Auth::user()->avatar) {
            Storage::delete('/public/images/' . Auth::user()->avatar);
        }
    }

    // relationships - One to many
    public function todos() {
        return $this->hasMany(Todo::class);
    }

    // // Mutator
    // public function setPasswordAttribute($password) {
    //     $this->attributes['password'] = bcrypt($password);
    // }

    // // Accessor
    // public function getNameAttribute($name) {
    //     return "My name is " . ucfirst($name);
    // }
}