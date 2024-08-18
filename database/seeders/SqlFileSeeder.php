<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SqlFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sqlFiles = [
            'sql/divisions.sql',
            'sql/districts.sql',
            'sql/upazilas.sql'
        ];

        foreach ($sqlFiles as $file) {
            // Path to the SQL file
            $path = database_path($file);

            // Check if file exists
            if (!File::exists($path)) {
                $this->command->error("SQL file does not exist at path: $path");
                continue;
            }

            // Read the SQL file
            $sql = File::get($path);

            // Execute the SQL file content
            DB::unprepared($sql);

            $this->command->info("SQL file at path $path imported successfully.");
        }
    }
}
