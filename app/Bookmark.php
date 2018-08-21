<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = [
      'title', 'url', 'description', 'user_id', 'category_id', 'type_id'
    ];

    public function category() {
      return $this->belongsTo('App\Category', 'category_id');
    }

    public function user() {
      return $this->belongsTo('App\User', 'user_id');
    }

    public function type() {
      return $this->belongsTo('App\Type', 'type_id');
    }
}
