<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, SoftDeletes, HasUuids;
    protected $fillable = [
        'name', 'slug'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
