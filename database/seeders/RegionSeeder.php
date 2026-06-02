<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        $regions = [
            ['name' => 'Hà Nội', 'description' => 'Thủ đô ngàn năm văn hiến với nhiều di tích lịch sử và văn hóa'],
            ['name' => 'Hồ Chí Minh', 'description' => 'Thành phố năng động nhất Việt Nam, trung tâm kinh tế phía Nam'],
            ['name' => 'Đà Nẵng', 'description' => 'Thành phố biển đẹp nhất Miền Trung với những bãi biển tuyệt vời'],
            ['name' => 'Hội An', 'description' => 'Phố cổ di sản thế giới với vẻ đẹp cổ kính và lãng mạn'],
            ['name' => 'Huế', 'description' => 'Cố đô với nhiều di tích hoàng cung và ẩm thực đặc sắc'],
            ['name' => 'Nha Trang', 'description' => 'Thành phố biển xinh đẹp với làn nước trong xanh và hải sản tươi ngon'],
            ['name' => 'Phú Quốc', 'description' => 'Đảo ngọc thiên đường với rừng nguyên sinh và bãi biển hoang sơ'],
            ['name' => 'Sapa', 'description' => 'Vùng núi mây mù huyền bí với ruộng bậc thang kỳ vĩ'],
            ['name' => 'Hạ Long', 'description' => 'Kỳ quan thiên nhiên thế giới với hàng nghìn hòn đảo đá vôi'],
            ['name' => 'Đà Lạt', 'description' => 'Thành phố ngàn hoa với khí hậu mát mẻ quanh năm'],
            ['name' => 'Mũi Né', 'description' => 'Thiên đường nghỉ dưỡng ven biển với đồi cát độc đáo'],
            ['name' => 'Cần Thơ', 'description' => 'Thủ phủ miền Tây với sông nước và chợ nổi nổi tiếng'],
        ];

        foreach ($regions as $data) {
            Region::create([
                'name'        => $data['name'],
                'slug'        => Str::slug($data['name']),
                'description' => $data['description'],
            ]);
        }
    }
}
