<?php

namespace App\Models;

use App\Enums\TaskStatus;
use App\Models\Scopes\AuthorScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

// #[ScopedBy([AuthorScope::class])]
class Task extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Prunable;

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
        'status' => TaskStatus::class,
        'is_draft' => 'boolean',
    ];

    public function prunable(): Builder
    {
        return static::where('deleted_at' . '<=', now()->subDays(30));
    }

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

    public function scopePublished($query)
    {
        return $query->where('is_draft', false);
    }

    public function scopeByUser($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }
}
