<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'content',
        'meta_title',
        'meta_description',
        'is_active',
        'published_at',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    protected $dates = [
        'published_at'
    ];

    public function getPublishedAtAttribute($value): string
    {
        return Carbon::make($value)->format("Y-m-d\TH:i");
    }

    public function scopePublished($query)
    {
        return $query->where('is_active', true)
            ->whereDate('published_at', '>=', now()->toDateString())
            ->latest('published_at');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'article_tag', 'article_id', 'tag_id');
    }
}
