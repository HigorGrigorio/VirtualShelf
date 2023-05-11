<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $publishers = array(
            array('name' => 'Atena Editora', 'email' => 'contato@atenaeditora.com.br'),
            array('name' => 'Moderna', 'email' => 'contato@moderna.com.br'),
            array('name' => 'Writing Tips Oasis', 'email' => 'contato@writingtipsoasis.com')
        );

        // check for state São Paulo

        foreach ($publishers as $publisher) {
            Publisher::factory()->withState('São Paulo')->create($publisher);
        }
    }
}
