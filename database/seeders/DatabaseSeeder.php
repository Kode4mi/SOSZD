<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use \App\Models\Ticket;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(4)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Ticket::factory(40)->create();

        User::factory()->create([
            'first_name' => "Renata",
            'last_name' => "Jokisz-Rogucka",
            'email' => 'admin@soszd.pl',
            'password' => '$2y$10$rcQUWtlo3oPpmxroFw8nV.OVOMf94/ETYqO/7lhFpm0NPtc3z/LmO',
            'role'=> 'admin',
        ]);

    }
}
