<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }
}