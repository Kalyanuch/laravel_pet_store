<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Product entity model.
 */
class Product extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['title', 'sort_order', 'status', 'description', 'price', 'quantity'];

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
     * Prepare resizable image.
     *
     * @param int $width
     *   Image width.
     * @param int $height
     *   Image height.
     *
     * @return string
     *   Path to image.
     */
    public function getResizableImage(int $width, int $height) {
        if (!Storage::url($this->image)) {
            return '';
        }

        $image_info = pathinfo($this->image);

        $filename = $image_info['filename'] . '_' . $width . 'x' . $height . '.' . $image_info['extension'];

        $path = $image_info['dirname'] . '/' .$filename;

        if (!Storage::has($path)) {
            $public_path = public_path(Storage::url($this->image));
            $new_path = str_replace($this->image, '', $public_path) . $path;

            $image = Image::make($public_path);

            $image->resize($width, $height)->save($new_path);
        }

        return $path;
    }

    /**
     * Deleting images cache.
     */
    public function removeImageCache() {
        if ($this->image) {
            $image_info = pathinfo($this->image);
            $public_path = public_path(Storage::url($this->image));
            $pattern = str_replace('.' . $image_info['extension'], '', $public_path) . '*';

            foreach (glob($pattern) as $file) {
                unlink($file);
            }
        }

        return $this;
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
     * Gets only enabled products.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return void
     */
    public function scopeIsActive(Builder $query): void
    {
        $query->where('status', '=', TRUE);
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

    /**
     * Gets the image with thumb size.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function thumb(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image ? $this->getResizableImage(100, 100) : '',
        );
    }

    /**
     * Gets the image with catalog size.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function listImage(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image ? $this->getResizableImage(690, 690) : '',
        );
    }
}
