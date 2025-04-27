<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'content',
        'category_id',
        'slug',
        'user_id',
        'published_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function claps()
    {
        return $this->hasMany(Clap::class);
    }

    public function readTime()
    {
        $words = str_word_count(strip_tags($this->content));
        $minutes = floor($words / 200);
        $seconds = floor($words % 200 / 0.2);
        return $minutes . ' min' . ($minutes > 1 ? 's' : '') . ' ' . $seconds . ' sec' . ($seconds > 1 ? 's' : '');
    }

    public function imageUrl(string $conversionName = '')
    {
        return $this->getFirstMedia()?->getUrl($conversionName);
    }


    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('preview')->width(400);
        $this->addMediaConversion('large')->width(1200);
    }

}
