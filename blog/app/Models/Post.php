<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'body',
        'user_id'
    ];

    public function file(): HasOne
    {
        return $this->hasOne(File::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
}
