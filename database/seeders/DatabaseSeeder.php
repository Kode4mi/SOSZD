<?php /** @noinspection SpellCheckingInspection */

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Redirect;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Ticket;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $users=User::factory(20)->make();
        $id = 1;
        foreach ($users as $user) {
            $slug = $id."-".$user->first_name."-".$user->last_name;
            User::factory()->create([
                'slug' => md5($slug)
            ]);
            $id++;
        }


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->create([
            'first_name' => "Renata",
            'last_name' => "Jokisz-Rogucka",
            'email' => 'admin@soszd.pl',
            'password' => '$2y$10$rcQUWtlo3oPpmxroFw8nV.OVOMf94/ETYqO/7lhFpm0NPtc3z/LmO',
            'role'=> 'admin',
            'slug' => md5($id."-Renata-Jokisz-Rogucka")
        ]);

        $id++;
        User::factory()->create([
            'first_name' => "Beata",
            'last_name' => "Mulsanowska",
            'email' => 'uzytkownik@soszd.pl',
            'password' => '$2y$10$4K2iVZ.fQxYBf/oX9IwvP.K59AAt//78pkOqtEYAcwNa81g1/RepC',
            'slug' => md5($id."-Beata-Mulsanowska")
        ]);


        $tickets=Ticket::factory(40)->make();
        $id = 1;


        foreach ($tickets as $ticket) {
            $slug = $id."-".$ticket->title.$ticket->created_at;
            Ticket::factory()->create([
                'slug' => md5($slug)
            ]);

            $id++;
        }

        $redirects = Redirect::factory(15)->make();

        $id = 1;

        foreach ($redirects as $re) {
            $slug = $id."-".$re->ticket_id."-".$re->user_id;
            Redirect::factory()->create([
                'slug' => md5($slug),
            ]);

            $id++;
        }

    }
}
