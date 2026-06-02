<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Region;
use App\Models\DestinationType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = [
            [
                'name' => 'Vịnh Hạ Long',
                'region' => 'Hạ Long',
                'type' => 'Đảo & Vịnh',
                'description' => 'Vịnh Hạ Long là một kỳ quan thiên nhiên thế giới được UNESCO công nhận. Với hơn 1.600 hòn đảo đá vôi nhô lên khỏi mặt nước xanh ngọc bích, tạo nên một cảnh quan thiên nhiên hùng vĩ và thơ mộng. Du khách có thể khám phá các hang động, đi thuyền kayak qua các vách đá vôi dựng đứng, hay ngủ đêm trên du thuyền để tận hưởng vẻ đẹp huyền ảo của vịnh.',
                'tips' => "- Đi thuyền khám phá hang Sửng Sốt, hang Thiên Cung\n- Chèo kayak qua các hòn đảo nhỏ\n- Ngủ đêm trên du thuyền để ngắm bình minh\n- Thử hải sản tươi sống trên thuyền\n- Thời điểm đẹp nhất: tháng 3-5 và 9-11",
                'address' => 'Vịnh Hạ Long, Quảng Ninh',
                'latitude' => 20.9101,
                'longitude' => 107.1839,
                'popularity' => 950,
                'is_featured' => true,
            ],
            [
                'name' => 'Hội An Phố Cổ',
                'region' => 'Hội An',
                'type' => 'Phố cổ & Làng nghề',
                'description' => 'Phố cổ Hội An là một trong những điểm đến du lịch hấp dẫn nhất Việt Nam. Được UNESCO công nhận là Di sản Văn hóa Thế giới, Hội An nổi tiếng với những ngôi nhà cổ được bảo tồn tốt, đèn lồng rực rỡ và ẩm thực đặc sắc. Thả đèn hoa đăng trên sông Hoài vào đêm rằm là trải nghiệm không thể bỏ qua.',
                'tips' => "- Thả đèn hoa đăng trên sông Hoài\n- Tham quan Nhà cổ Tấn Ký, Chùa Cầu\n- Mặc áo dài chụp ảnh trên phố cổ\n- Thử Cao Lầu, Mì Quảng, Bánh Mì Hội An\n- Thời điểm đẹp nhất: tháng 2-4",
                'address' => 'Phố cổ Hội An, Quảng Nam',
                'latitude' => 15.8801,
                'longitude' => 108.3380,
                'popularity' => 880,
                'is_featured' => true,
            ],
            [
                'name' => 'Đại Nội Huế',
                'region' => 'Huế',
                'type' => 'Di tích lịch sử',
                'description' => 'Đại Nội Huế hay còn gọi là Kinh thành Huế là quần thể di tích lịch sử gắn liền với 13 đời vua Nguyễn. Được UNESCO công nhận là Di sản Văn hóa Thế giới, nơi đây lưu giữ nhiều công trình kiến trúc độc đáo như Ngọ Môn, Điện Thái Hòa, Tử Cấm Thành và nhiều đền đài, lăng tẩm hoàng gia.',
                'tips' => "- Thuê xe đạp tham quan các lăng tẩm\n- Xem trình diễn nhã nhạc cung đình\n- Thử ẩm thực cung đình Huế\n- Tham quan lăng Khải Định, lăng Tự Đức\n- Thời điểm đẹp nhất: tháng 1-4",
                'address' => 'Đại Nội Huế, Thừa Thiên Huế',
                'latitude' => 16.4698,
                'longitude' => 107.5796,
                'popularity' => 760,
                'is_featured' => true,
            ],
            [
                'name' => 'Bãi biển Mỹ Khê',
                'region' => 'Đà Nẵng',
                'type' => 'Bãi biển',
                'description' => 'Bãi biển Mỹ Khê được tạp chí Forbes bình chọn là một trong những bãi biển quyến rũ nhất hành tinh. Với bờ cát trắng mịn kéo dài hơn 9km, sóng biển vừa phải và nước biển trong xanh, Mỹ Khê là điểm đến lý tưởng cho các hoạt động thể thao biển và nghỉ dưỡng.',
                'tips' => "- Tắm biển vào buổi sáng sớm\n- Thử lướt sóng, dù bay\n- Thưởng thức hải sản tươi tại các nhà hàng ven biển\n- Kết hợp tham quan Bà Nà Hills, Ngũ Hành Sơn\n- Thời điểm đẹp nhất: tháng 5-9",
                'address' => 'Đường Võ Nguyên Giáp, Đà Nẵng',
                'latitude' => 16.0670,
                'longitude' => 108.2483,
                'popularity' => 820,
                'is_featured' => true,
            ],
            [
                'name' => 'Phú Quốc Đảo Ngọc',
                'region' => 'Phú Quốc',
                'type' => 'Đảo & Vịnh',
                'description' => 'Phú Quốc được mệnh danh là "Đảo Ngọc" của Việt Nam với những bãi biển hoang sơ tuyệt đẹp, rừng quốc gia nguyên sinh và hải sản đặc sản nổi tiếng. Đảo có nhiều khu nghỉ dưỡng 5 sao đẳng cấp quốc tế và công viên VinWonders hoành tráng.',
                'tips' => "- Tham quan VinWonders và Vinpearl Safari\n- Lặn biển ngắm san hô ở An Thới\n- Tham quan chợ đêm Phú Quốc\n- Thử rượu sim, nước mắm Phú Quốc\n- Thuê xe máy khám phá toàn đảo",
                'address' => 'Đảo Phú Quốc, Kiên Giang',
                'latitude' => 10.2897,
                'longitude' => 103.9840,
                'popularity' => 900,
                'is_featured' => true,
            ],
            [
                'name' => 'Ruộng bậc thang Sapa',
                'region' => 'Sapa',
                'type' => 'Núi & Thiên nhiên',
                'description' => 'Ruộng bậc thang Sapa là một trong những cảnh quan thiên nhiên đẹp nhất Đông Nam Á. Những thửa ruộng bậc thang uốn lượn trải dài theo sườn núi tạo nên một bức tranh thiên nhiên hùng vĩ. Vào mùa lúa chín (tháng 9-10), toàn bộ cánh đồng chuyển thành màu vàng óng rực rỡ.',
                'tips' => "- Đi trekking qua làng Cát Cát, Lao Chải\n- Leo Fansipan - nóc nhà Đông Dương\n- Tham quan chợ phiên vùng cao cuối tuần\n- Khám phá văn hóa người H'Mông, Dao Đỏ\n- Thời điểm đẹp nhất: tháng 9-10 (mùa lúa chín)",
                'address' => 'Thị trấn Sapa, Lào Cai',
                'latitude' => 22.3364,
                'longitude' => 103.8438,
                'popularity' => 840,
                'is_featured' => true,
            ],
            [
                'name' => 'Hồ Hoàn Kiếm',
                'region' => 'Hà Nội',
                'type' => 'Di tích lịch sử',
                'description' => 'Hồ Hoàn Kiếm là trái tim của thủ đô Hà Nội, gắn liền với truyền thuyết về Rùa Thần và Kiếm Báu của vua Lê Lợi. Xung quanh hồ là Tháp Rùa cổ kính, Đền Ngọc Sơn và Cầu Thê Húc sơn đỏ - biểu tượng của Hà Nội ngàn năm văn hiến.',
                'tips' => "- Tham quan Đền Ngọc Sơn qua Cầu Thê Húc\n- Đi bộ quanh hồ vào buổi sáng\n- Khám phá phố cổ 36 phố phường\n- Thử Bánh Mì, Phở, Bún Chả Hà Nội\n- Xem múa rối nước Thăng Long",
                'address' => 'Hồ Hoàn Kiếm, Hoàn Kiếm, Hà Nội',
                'latitude' => 21.0285,
                'longitude' => 105.8542,
                'popularity' => 780,
                'is_featured' => false,
            ],
            [
                'name' => 'Bà Nà Hills',
                'region' => 'Đà Nẵng',
                'type' => 'Khu vui chơi',
                'description' => 'Bà Nà Hills là khu du lịch nghỉ dưỡng nổi tiếng nằm ở độ cao 1.487m so với mực nước biển. Nơi đây nổi tiếng với Cầu Vàng - tuyệt tác kiến trúc độc đáo với hai bàn tay khổng lồ đỡ cầu, tuyến cáp treo đạt nhiều kỷ lục thế giới và khu vui chơi Fantasy Park.',
                'tips' => "- Chụp ảnh tại Cầu Vàng\n- Trải nghiệm cáp treo dài nhất Đông Nam Á\n- Khám phá Fantasy Park và Village France\n- Ngắm mây từ đỉnh núi\n- Nên đi vào buổi sáng để tránh đông",
                'address' => 'Bà Nà, Hòa Vang, Đà Nẵng',
                'latitude' => 15.9973,
                'longitude' => 107.9928,
                'popularity' => 870,
                'is_featured' => true,
            ],
            [
                'name' => 'Chợ Bến Thành',
                'region' => 'Hồ Chí Minh',
                'type' => 'Ẩm thực & Chợ',
                'description' => 'Chợ Bến Thành là biểu tượng lịch sử và văn hóa của Thành phố Hồ Chí Minh. Được xây dựng từ năm 1914, chợ là điểm mua sắm, ẩm thực và tham quan nổi tiếng nhất thành phố. Ban đêm, khu vực xung quanh chợ trở thành một chợ đêm sôi động với hàng trăm gian hàng.',
                'tips' => "- Mặc cả khi mua hàng\n- Thử ăn sáng trong chợ (Bánh Mì, Hủ Tiếu)\n- Khám phá chợ đêm Bến Thành\n- Kết hợp tham quan Nhà thờ Đức Bà, Dinh Thống Nhất\n- Cảnh giác với móc túi",
                'address' => 'Chợ Bến Thành, Quận 1, TP.HCM',
                'latitude' => 10.7724,
                'longitude' => 106.6981,
                'popularity' => 720,
                'is_featured' => false,
            ],
            [
                'name' => 'Vườn hoa Đà Lạt',
                'region' => 'Đà Lạt',
                'type' => 'Núi & Thiên nhiên',
                'description' => 'Đà Lạt - thành phố ngàn hoa với khí hậu mát mẻ quanh năm là thiên đường của những loài hoa. Vườn hoa Đà Lạt trưng bày hàng trăm loài hoa đặc trưng của vùng cao nguyên. Thung lũng Tình Yêu, hồ Xuân Hương và đồi Mộng Mơ là những điểm check-in nổi tiếng.',
                'tips' => "- Thuê xe máy khám phá các con đường ngập hoa\n- Tham quan Thung lũng Tình Yêu, đồi Mộng Mơ\n- Thử đặc sản: Bánh tráng nướng, Artichoke\n- Mua dâu tây tươi tại các vườn\n- Thời điểm đẹp nhất: tháng 12-3",
                'address' => 'Đường Phù Đổng Thiên Vương, Đà Lạt',
                'latitude' => 11.9404,
                'longitude' => 108.4418,
                'popularity' => 760,
                'is_featured' => false,
            ],
            [
                'name' => 'Nha Trang Beach',
                'region' => 'Nha Trang',
                'type' => 'Bãi biển',
                'description' => 'Nha Trang là thành phố biển nổi tiếng nhất Việt Nam với đường bờ biển dài 6km cát trắng mịn và nước biển trong xanh. Vịnh Nha Trang là một trong những vịnh đẹp nhất thế giới với nhiều hòn đảo nhỏ xinh đẹp như Hòn Mun, Hòn Tằm.',
                'tips' => "- Lặn biển ngắm san hô ở Hòn Mun\n- Tắm bùn khoáng ở I-Resort\n- Tham quan Tháp Chàm Ponagar\n- Đi cáp treo Hòn Thơm\n- Thời điểm đẹp nhất: tháng 6-9",
                'address' => 'Bãi biển Nha Trang, Khánh Hòa',
                'latitude' => 12.2388,
                'longitude' => 109.1967,
                'popularity' => 800,
                'is_featured' => false,
            ],
            [
                'name' => 'Chợ Nổi Cái Răng',
                'region' => 'Cần Thơ',
                'type' => 'Ẩm thực & Chợ',
                'description' => 'Chợ nổi Cái Răng là chợ nổi lớn nhất miền Tây Nam Bộ, họp từ 5 giờ sáng đến khoảng 8-9 giờ. Hàng trăm chiếc thuyền tụ họp trên sông buôn bán các loại nông sản, trái cây đặc trưng của miền Tây. Đây là điểm đến đặc trưng không thể bỏ qua khi đến Cần Thơ.',
                'tips' => "- Thuê thuyền nhỏ từ 5-7 giờ sáng\n- Ăn sáng trên thuyền (bún, phở)\n- Mua trái cây đặc sản miền Tây\n- Kết hợp thăm làng nghề bánh tráng\n- Chụp ảnh bình minh trên sông",
                'address' => 'Chợ nổi Cái Răng, Cần Thơ',
                'latitude' => 10.0227,
                'longitude' => 105.7617,
                'popularity' => 650,
                'is_featured' => false,
            ],
        ];

        foreach ($destinations as $data) {
            $region = Region::where('name', $data['region'])->first();
            $type = DestinationType::where('name', $data['type'])->first();

            if ($region && $type) {
                Destination::create([
                    'name'                => $data['name'],
                    'slug'                => Str::slug($data['name']),
                    'region_id'           => $region->id,
                    'destination_type_id' => $type->id,
                    'description'         => $data['description'],
                    'tips'                => $data['tips'],
                    'address'             => $data['address'],
                    'latitude'            => $data['latitude'],
                    'longitude'           => $data['longitude'],
                    'popularity'          => $data['popularity'],
                    'is_featured'         => $data['is_featured'],
                ]);
            }
        }
    }
}
