<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'completed', 'categoryId', 'task_count'];


    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }

    protected static function booted()
    {

        static::created(function ($task) {
            if ($task->category) {
                $task->category->increment('tasks_count');
            }
        });


        static::deleted(function ($task) {
            if ($task->category) {
                $task->category->decrement('tasks_count');
            }else{
            }

        });
    }

}
