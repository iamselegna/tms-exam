<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tasks';

    protected $fillable = [
        'slug',
        'title',
        'content',
        'is_draft',
        'status',
        'sub_tasks',
    ];

    protected $casts = [
        'sub_tasks' => 'array',
        'status' => TaskStatus::class
    ];

    // public function status(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn (string $value) => TaskStatus::fromValue($value),
    //     );
    // }

    public function upload(): MorphOne
    {
        return $this->morphOne(Upload::class, 'uploadable');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%' . $search . '%');
    }
}
