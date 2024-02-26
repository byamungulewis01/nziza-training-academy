<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $collections = [
            ['name' => 'Rwanda' ],
            ['name' => 'Tanzania' ],
        ];
        foreach ($collections as $item) {
            Branch::create($item);
        }
    }
}
