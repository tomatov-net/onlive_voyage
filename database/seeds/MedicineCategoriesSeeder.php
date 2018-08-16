<?php

use Illuminate\Database\Seeder;

class MedicineCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(\App\MedicineCategory::class, 10)->create();
        /**
         * Взято отсюда: https://biosfera.kz/product/category?path=13
         */
        $categories = [
            ['name' => 'Антибиотики',],
            ['name' => 'Витамины',],
            ['name' => 'Средства от аллергии',],
            ['name' => 'Дерматологические средства',],
            ['name' => 'Заболевания глаз',],
            ['name' => 'Заболевания дыхательной системы',],
            ['name' => 'Противогрибковые средства',],
            ['name' => 'Лечебные масла',],
            ['name' => 'Антибактериальные средства',],
            ['name' => 'Противовирусные средства',],
            ['name' => 'Разное',],
        ];

        foreach ($categories as $item) {
            \App\MedicineCategory::create($item);
        }
    }
}
