<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Works extends Model
{
    protected $fillable = ['title', 'cat_id', 'description', 'file'];

    public function tags()
    {
        return $this->belongsToMany('App\Models\tags', 'work_tags', 'work_id', 'tag_id');
    }
}
