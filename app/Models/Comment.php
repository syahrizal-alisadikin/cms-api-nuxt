<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = [
        'post_id', 'name', 'email', 'comment'
    ];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => \Carbon\Carbon::locale('id')->parse($value)->translatedFormat('l, d F Y'),
        );
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => \Carbon\Carbon::locale('id')->parse($value)->translatedFormat('l, d F Y'),
        );
    }
}
