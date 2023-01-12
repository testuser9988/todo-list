<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id', 'status','time_limit', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
