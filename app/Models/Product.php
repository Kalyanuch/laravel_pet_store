<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Product entity model.
 */
class Product extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['title', 'sort_order', 'status', 'description'];

    /**
     * Gets product categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
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
     * Sets the sort order default value.
     */
    protected function sortOrder(): Attribute
    {
        return Attribute::make(
            set: fn (?string $value) => ($value ?? 0),
        );
    }
}
