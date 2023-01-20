<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Category extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = [
        'name', 'slug', 'image'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('/storage/categories/' . $value),
        );
    }
}
