<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'checklist_id', 'user_id', 'status_checked'];

    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }
}