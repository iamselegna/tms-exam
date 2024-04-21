<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'slug',
        'title',
        'is_draft',
        'sub_tasks',
    ];

    public function status()
    {
        return $this->belongsTo(TaskStatusReference::class, 'status_id');
    }

    public function upload(): MorphOne
    {
        return $this->morphOne(Upload::class, 'uploadable');
    }
}
