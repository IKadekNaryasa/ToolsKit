<?php

namespace Database\Seeders;

use App\Models\Tool;
use App\Models\User;
use App\Models\MntTool;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Inventory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        User::create([
            'id' => Str::uuid(),
            'username' => 'chitos.ikn',
            'password' => Hash::make('12345678'),
            'contact' => '+6287864365344',
            'name' => 'I Kadek Naryasa',
            'role' => 'admin',
            'status' => 'active',
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'id' => Str::uuid(),
            'username' => 'chitos.teknisi',
            'password' => Hash::make('12345678'),
            'contact' => '+6288997759859',
            'name' => 'I Kadek Naryasa',
            'role' => 'technician',
            'status' => 'active',
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'id' => Str::uuid(),
            'username' => 'chitos.head',
            'password' => Hash::make('12345678'),
            'contact' => '+9387547984690',
            'name' => 'I Kadek Naryasa',
            'role' => 'head',
            'status' => 'active',
            'remember_token' => Str::random(10),
        ]);

        Inventory::factory(5)->create();
        // Tool::factory(21)->create();
        // Tool::factory(1)->maintenance()->create();
        // Tool::factory(1)->repair()->create();
        // Tool::factory(1)->damaged()->create();
        // Tool::factory(1)->borrowed()->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
