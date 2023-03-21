<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Image extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillable = ['name', 'file', 'enable'];
    protected $casts = [
        'enable' => 'boolean'
    ];

    public function products (): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_image', 'image_id', 'product_id');
    }

    protected function file(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => asset($value)
        );
    }
}
