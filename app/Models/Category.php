<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Category entity model.
 */
class Category extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['title', 'status', 'parent_id'];

    /**
     * Gets category products.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Configuration for slugs generator.
     *
     * @return array[]
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Gets only root categories.
     *
     * @param Builder $query
     *   Query builder.
     *
     * @return void
     */
    public function scopeRootCategories(Builder $query): void
    {
        $query->where('parent_id', '=', 0);
    }
}
