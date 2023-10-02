<?php

namespace App\Models;

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
        "status_id",
        "user_id", // created                                                                                                                                      
    ];

    protected $with = ['categories'];


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'task_categories');
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assignees()
    {
        return $this->belongsToMany(User::class, 'task_users');
    }
}
