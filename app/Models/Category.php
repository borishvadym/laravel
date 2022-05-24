<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'sort_order',
        'title',
        'slug',
        'description',
        'meta_title',
        'meta_description',
    ];

    public $timestamps = false;

    public function scopeRoot($query)
    {
        return $query->where('parent_id', 0);
    }

    public function scopeNotRoot($query)
    {
        return $query->where('parent_id', '!=', 0);
    }

    public function scopeAvailableForArticles($query)
    {
        return $query->where(function ($q) {
                $q->whereDoesntHave('subCategories')->where('parent_id', 0);
            })
            ->orWhere(function ($q) {
                $q->where('parent_id', '!=', 0);
            });
    }

    public function scopeSorted($query)
    {
        return $query->orderBy('sort_order', 'ASC');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function subCategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->sorted();
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'category_id');
    }
}
