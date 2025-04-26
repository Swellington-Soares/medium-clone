<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'category_id',
        'slug',
        'image',
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

    public function readTime(){
        $words = str_word_count(strip_tags($this->content));
        $minutes = floor($words / 200);
        $seconds = floor($words % 200 / 0.2);
        return $minutes . ' min' . ($minutes > 1 ? 's' : '') . ' ' . $seconds . ' sec' . ($seconds > 1 ? 's' : '');
    }

    public function imageUrl() {
        if ($this->image) {
            return Storage::url($this->image);
        }
    }




}
