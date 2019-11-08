<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('products')->insert([
            'name' => 'Celular',
            'description' => 'LG',
            'user_id' => 1,
        ]);
        DB::table('products')->insert([
            'name' => 'Notebook',
            'description' => 'Dell',
            'user_id' => 1,
        ]);
        DB::table('pedidos')->insert([
            'quantidade' => 5,
            'product_id' => 1,
            'user_id' => 1,
        ]);
        DB::table('pedidos')->insert([
            'quantidade' => 2,
            'product_id' => 2,
            'user_id' => 1,
        ]);
        
    }
}
