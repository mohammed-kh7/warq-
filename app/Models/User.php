<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'location',
        'image',
        'is_admin',
        'is_moderator',
        'is_author',
        'is_teacher',
        'bio',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // في موديل الـUser
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function emergencyRequests()
    {
        return $this->hasMany(emergencyRequest::class);
    }

    public function userBooks()
    {
        return $this->hasMany(UserBook::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Product::class, 'favorites');
    }

    public function roleApplications()
    {
        return $this->hasMany(RoleApplication::class);
    }

    public function communityPosts()
    {
        return $this->hasMany(CommunityPost::class);
    }

    public function contentRequests()
    {
        return $this->hasMany(ContentRequest::class);
    }

    protected static function booted()
    {
        static::created(function ($user) {
            $user->create([
                'status' => 'completed',
            ]);
        });
    }
}
