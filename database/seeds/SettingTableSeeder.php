<?php

use Illuminate\Database\Seeder;

use App\Setting;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_table_key_exsits = Setting::where('name', 'data_tabel_settings_view_columns')->first();
        if (!$data_table_key_exsits) {
            Setting::create([
                'slug' => 'إعدادات عرض الجداول',
                'name' => 'data_tabel_settings_view_columns',
                'value' => '{}'
            ]);
        }
    }
}
