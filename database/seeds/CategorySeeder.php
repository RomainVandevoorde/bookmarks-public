<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    public $categories = ['Git', 'HTML', 'CSS', 'Design', 'Javascript', 'jQuery', 'PHP', 'SQL', 'AJAX', 'Gaming'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\User::class, 3)->make();
        // factory(App\Category::class, 20)->create();
        foreach($this->categories as $category) {
            DB::table('categories')->insert([
                'title' => $category
            ]);
        }
    }
}
