<?php

namespace App\Models\task;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "duration",
        "due_date",
        "complete",
        "task_status_id",
    ];
}