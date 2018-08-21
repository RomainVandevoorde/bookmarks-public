<?php

use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{

    public $types = ['Article', 'Vidéo', 'Documentation', 'Outil', 'Librairie', 'Framework'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->types as $type) {
            DB::table('types')->insert([
                'name' => $type
            ]);
        }
    }
}
