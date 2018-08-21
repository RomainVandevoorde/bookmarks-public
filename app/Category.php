<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    protected $fillable = ['title'];

    public function bookmarks() {
      return $this->hasMany('App\Bookmark', 'category_id', 'id');
    }
}
