<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'about_hero_title'    => 'Elevating Excellence',
            'about_hero_subtitle' => 'Kami hadir untuk memberikan pengalaman belanja elektronik terbaik di Indonesia',
            'about_story_text1'   => 'Diluncurkan pada 2015, Exitem adalah marketplace belanja online terkemuka di Asia Selatan. Kami melayani lebih dari 3 juta pelanggan di seluruh wilayah dengan lebih dari 1 juta produk elektronik berkualitas.',
            'about_story_text2'   => 'Dengan dukungan 10.500 penjual dan 300 merek ternama, Exitem terus bertumbuh dengan cepat untuk memberikan solusi elektronik terlengkap bagi masyarakat Indonesia.',
            'about_stat1_value'   => '15K+',
            'about_stat1_label'   => 'Happy Users',
            'about_stat2_value'   => '500+',
            'about_stat2_label'   => 'Daily Transactions',
            'about_stat3_value'   => '99%',
            'about_stat3_label'   => 'Satisfaction Rate',
        ];

        foreach ($settings as $key => $value) {
            \App\Models\Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
