<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\MntTool;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Inventory;
use App\Models\Tool;
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
        Tool::factory(21)->create();
        Tool::factory(1)->maintenance()->create();
        Tool::factory(1)->repair()->create();
        Tool::factory(1)->damaged()->create();
        Tool::factory(1)->borrowed()->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
