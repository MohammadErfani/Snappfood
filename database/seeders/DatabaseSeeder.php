<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $disounts = [
            ['title' => 'Twenty percent', 'percentage' => 0.2],
            ['title' => 'Tenth percent', 'percentage' => 0.1],
            ['title' => 'Thirty percent', 'percentage' => 0.3],
            ['title' => 'Forty percent', 'percentage' => 0.4],

        ];
        foreach ($disounts as $discount) {
            DB::table('discounts')->insert($discount);
        }
    }
}
