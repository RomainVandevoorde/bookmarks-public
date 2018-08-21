<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Category;

class CategoriesComposer
{

  protected $categories;

  public function __construct(Category $category) {
    $this->categories = $category;
  }

  public function compose(View $view) {
    $view->with('categories', $this->categories->all());
  }

}



?>
