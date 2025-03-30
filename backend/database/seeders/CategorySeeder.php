<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Salário'],
            ['name' => 'Alimentação'],
            ['name' => 'Transporte'],
            ['name' => 'Lazer'],
            ['name' => 'Saúde'],
            ['name' => 'Educação'],
            ['name' => 'Outros'],
        ];

        DB::table('categories')->insert($categories);
    }
}
