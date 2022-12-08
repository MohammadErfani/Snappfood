<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Restaurant\Restaurant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

//         \App\Models\User::factory()->create([
//             'name' => 'Test User',
//             'email' => 'test@example.com',
//         ]);
        $disounts = [
            ['title' => 'Twenty percent', 'percentage' => 0.2],
            ['title' => 'Tenth percent', 'percentage' => 0.1],
            ['title' => 'Thirty percent', 'percentage' => 0.3],
            ['title' => 'Forty percent', 'percentage' => 0.4],

        ];
        foreach ($disounts as $discount) {
            DB::table('discounts')->insert($discount);
        }
        $categories = [
            ['name'=>'fast food'],
            ['name'=>'pizza','parent_category'=>1],
            ['name'=>'sandwich','parent_category'=>1],
            ['name'=>'Iranian'],
            ['name'=>'kabab','parent_category'=>4],
        ];
        foreach ($categories as $category){
            DB::table('food_categories')->insert($category);
            DB::table('restaurant_categories')->insert($category);
        }
        DB::table('admins')->insert([
           'name'=>'mohammad',
           'email'=>'moerfani78@gmail.com',
           'password'=>Hash::make('1234')
        ]);
    }
}
