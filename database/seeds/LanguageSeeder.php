<?php

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'abbr'=>'ar',
            'locale'=>'rtl',
            'name'=>'ar',
            'direction'=>'rtl',
            'active'=>1
        ]);

        Language::create([
            'abbr'=>'en',
            'locale'=>'ltr',
            'name'=>'en',
            'direction'=>'ltr',
            'active'=>1
        ]);
    }
}
