<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    public function bookmarks() {
      return $this->hasMany('App\Bookmark');
    }
}
