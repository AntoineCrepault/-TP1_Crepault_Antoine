<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SqlFilesSeeder extends Seeder
{
    /**
     * Run the database seeds from raw SQL files.
     */
    public function run(): void
    {
        $files = [
            base_path('tp1-ressources/sports.sql'),
            base_path('tp1-ressources/categories.sql'),
            base_path('tp1-ressources/equipments.sql'),
            base_path('tp1-ressources/equipment_sport.sql'),
        ];

        //AI: Aide moi a creer un seeder pour se tableau de sql

        foreach ($files as $sqlFile) {
                DB::unprepared(File::get($sqlFile));
        }
    }
}
