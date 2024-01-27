<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;


    const ROLE_ADMIN = 'ADMIN';
    const ROLE_EDITOR = 'EDITOR';
    const ROLE_USER = 'USER';
    const ROLE_DEFAULT = self::ROLE_USER;


    const ROLES = [
        self::ROLE_ADMIN => self::ROLE_ADMIN,
        self::ROLE_EDITOR => self::ROLE_EDITOR,
        self::ROLE_USER => self::ROLE_USER,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function Likes()
    {
        return $this->belongsToMany(Post::class, 'post_like')->withTimestamps();
    }

    public function HasLiked(Post $Post)
    {
        return $this->Likes()->where('post_id', $Post->id)->exists();
    }

    public function Comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->can('view-admin', User::class);
    }

    public function IsAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function IsEditor()
    {
        return $this->role === self::ROLE_EDITOR;
    }
}
