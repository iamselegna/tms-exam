<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatusReference extends Model
{
    use HasFactory;

    protected $table = 'task_status_references';

    protected $fillable = ['slug', 'title'];
}
