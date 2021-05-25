<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::factory()->create();
        User::create([
            'name' => 'James Requejo',
            'email' => 'james.requejo@groupjjinversiones.com',
            'email_verified_at' => now(),
            'password' => Hash::make('J4m3sR3qu3j0'), // password
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'Juan Gonzales',
            'email' => 'juan.gonzales@groupjjinversiones.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Ju4nG0nz4l3s'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}
