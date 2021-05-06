<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    public $fillable = ['task_name', 'task_description', 'statuses_id'];

    public function statuses()
    {
        return $this->belongsTo('App\Models\Statuses');
    }
}
