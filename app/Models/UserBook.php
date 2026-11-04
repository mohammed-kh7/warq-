<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'status',
        'progress',
        'last_page',
        'bookmarks',
        'slug',
    ];

    protected $casts = [
        'bookmarks' => 'array',
    ];

    protected static function booted()
    {
        static::creating(function ($userBook) {
            if (empty($userBook->slug)) {
                $userBook->slug = Str::slug($userBook->user_id . '-' . $userBook->book_id . '-' . time());
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Product::class, 'book_id');
    }

    public function markAsReading()
    {
        return $this->update(['status' => 'reading']);
    }

    public function markAsCompleted()
    {
        return $this->update(['status' => 'completed', 'progress' => 100]);
    }

    public function addBookmark($page, $label = null)
    {
        $bookmarks = $this->bookmarks ?? [];
        $bookmarks[] = [
            'page' => $page,
            'label' => $label,
            'created_at' => now(),
        ];
        return $this->update(['bookmarks' => $bookmarks]);
    }
}