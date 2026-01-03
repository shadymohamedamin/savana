<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PrimaryDataImport;

class PrimaryDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * 
     * UPDATE primary_datas
     *   SET Section = 1
     *   WHERE Section = 2;
     */
    public function run(): void
    {
        Excel::import(new PrimaryDataImport, storage_path('app/PrimaryData.xlsx'));
    }
}
