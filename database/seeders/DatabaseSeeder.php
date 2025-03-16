<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\MntTool;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Inventory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(2)->create();
        User::factory(10)->teknisi()->create();
        User::factory(1)->head()->create();
        Category::factory(5)->create();

        Inventory::factory(5)->create();
        MntTool::factory(21)->create();
        MntTool::factory(1)->perawatan()->create();
        MntTool::factory(1)->perbaikan()->create();
        MntTool::factory(1)->rusak()->create();
        MntTool::factory(1)->dipinjam()->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
