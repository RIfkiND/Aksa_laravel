<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Division;
class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = [
            ['name' => 'Mobile Apps'],
            ['name' => 'QA'],
            ['name' => 'Full Stack'],
            ['name' => 'Backend'],
            ['name' => 'Frontend'],
            ['name' => 'UI/UX Designer'],
        ];
        foreach ($divisions as $division) {
            Division::create($division);
        }
    }
}
