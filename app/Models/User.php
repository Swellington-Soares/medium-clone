<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Enums\CropPosition;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        // 'image',
        'bio',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function imageUrl()
    {
        return $this->getFirstMedia('avatar')?->getUrl('avatar') ?: "https://tamilnaducouncil.ac.in/wp-content/uploads/2020/04/dummy-avatar.jpg";
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    public function isFollowedBy(?User $user)
    {
        if (!$user) {
            return false;
        }

        return $this->followers()->where('follower_id', $user->id)->exists();
    }

    public function hasClapped(Post $post)
    {
        // dd($this->id, $post->claps()->where('user_id', $this->id)->exists());
        return $post->claps()->where('user_id', $this->id)->exists();
    }


    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('avatar')
            ->width(128)
            ->crop(128, 128, CropPosition::Center);

    }

    public function registerMediaCollections(): void {
        $this->addMediaCollection('avatar')->singleFile();
    }


}
