<?php

namespace Database\Seeders;

use App\Models\DestinationType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DestinationTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Bãi biển', 'icon' => '🏖️', 'description' => 'Bãi biển, đảo và khu nghỉ dưỡng ven biển'],
            ['name' => 'Núi & Thiên nhiên', 'icon' => '⛰️', 'description' => 'Núi cao, thác nước và khu bảo tồn thiên nhiên'],
            ['name' => 'Di tích lịch sử', 'icon' => '🏛️', 'description' => 'Đền, chùa, lăng tẩm và các di tích văn hóa lịch sử'],
            ['name' => 'Khu vui chơi', 'icon' => '🎡', 'description' => 'Công viên giải trí, khu du lịch sinh thái'],
            ['name' => 'Phố cổ & Làng nghề', 'icon' => '🏘️', 'description' => 'Phố cổ, làng nghề truyền thống và khu phố đặc sắc'],
            ['name' => 'Ẩm thực & Chợ', 'icon' => '🍜', 'description' => 'Chợ đêm, phố ẩm thực và trải nghiệm văn hóa ẩm thực'],
            ['name' => 'Đảo & Vịnh', 'icon' => '🏝️', 'description' => 'Đảo hoang sơ, vịnh biển và khu du lịch biển đảo'],
            ['name' => 'Thành phố', 'icon' => '🌆', 'description' => 'Trung tâm đô thị, tháp cao và điểm du lịch thành phố'],
        ];

        foreach ($types as $data) {
            DestinationType::create([
                'name'        => $data['name'],
                'slug'        => Str::slug($data['name']),
                'icon'        => $data['icon'],
                'description' => $data['description'],
            ]);
        }
    }
}
