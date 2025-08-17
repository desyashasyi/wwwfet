<?php

namespace Database\Seeders;

use App\Models\FetNet\ClientLevel;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Role::create(['name' => 'super-admin']);
        Role::create(['name' => 'client']);
        Role::create(['name' => 'program']);
        Role::create(['name' => 'cluster']);
        Role::create(['name' => 'teacher']);
        Role::create(['name' => 'student']);
        ClientLevel::create([
            'code' => 'FAC',
            'level' => 'Faculty',
        ]);
        ClientLevel::create([
            'code' => 'CLU',
            'level' => 'Cluster',
        ]);
        $user = User::factory()->create([
            'name' => 'FetNet',
            'email' => 'fetnet@techupi.id',
            'password' => Hash::make('Ddw9889##'),
        ]);

        $user->assignRole('super-admin');


    }
}
