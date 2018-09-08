<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    public $timestamps = false;
    protected $table = 'tags';
    protected $fillable = ['name'];

    public function works()
    {
        return $this->belongsToMany('App\Models\works', 'work_tags', 'work_id', 'tag_id');
    }
}
