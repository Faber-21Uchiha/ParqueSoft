<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
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

        $user=User::factory()->create([
             'name' => 'Admin',
             'email' => 'Admin@example.com',
         ]);
        $role = Role::create(['name' => 'Admin']);
        $user->assignRole($role);
    }
}
