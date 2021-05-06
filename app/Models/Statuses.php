<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statuses extends Model
{
    use HasFactory;

    public $fillable = ['name'];

    public function tasks()
    {
        return $this->hasMany('App\Models\Tasks');
    }
}
