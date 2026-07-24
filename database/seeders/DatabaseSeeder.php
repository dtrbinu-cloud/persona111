<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            QuestionSeeder::class,
        ]);

        $defaults = [
            'password' => Hash::make('password'),
            'xp' => 0,
            'level' => 1,
            'streak' => 0,
        ];

        if (Schema::hasColumn('users', 'name')) {
            $defaults['name'] = 'demo';
        }
        if (Schema::hasColumn('users', 'email')) {
            $defaults['email'] = 'demo@engpersona.local';
        }

        User::firstOrCreate([
            'username' => 'demo',
        ], $defaults);
    }
}
