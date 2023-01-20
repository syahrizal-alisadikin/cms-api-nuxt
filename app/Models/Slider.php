<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Slider extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = [
        'image'
    ];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('/storage/sliders/' . $value),
        );
    }
}
