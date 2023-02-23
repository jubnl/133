<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            ["title" => 'Se présenter aux consultations', "description" => 'Rattraper les 8h de consultation de la semaine dernière.'],
            ["title" => 'Fouiller appartement de Mme Thomson', "description" => 'Rechercher des traces de moisissures.'],
            ["title" => 'Remplacer la vicodin par des placebo ', "description" => 'Voir avec le pharmacien comment procéder exactement.'],
            ["title" => 'Faire la prise de sang à Mme Thomson au labo', "description" => 'Chambre 706, puis l\'envoyer au labo'],
            ["title" => 'Faire le test pour la chorée de huntington', "description" => 'Qu\'on soit fixer une fois pour toute !']
        ];

        foreach ($tasks as $task) {
            DB::table('tasks')->insert([
                'title' => $task['title'],
                'description' => $task['description'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
