<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'todo_id', 'user_id', 'status_deleted'];

    public function todo()
    {
        return $this->belongsTo(Todo::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
