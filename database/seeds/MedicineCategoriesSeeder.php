<?php

use Illuminate\Database\Seeder;

class MadicineCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\MedicineCategory::class, 10)->create();
    }
}
