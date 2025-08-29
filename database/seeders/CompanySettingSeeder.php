<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanySetting;

class CompanySettingSeeder extends Seeder
{
    public function run()
    {
        CompanySetting::truncate();

        CompanySetting::factory()->create([
            'company_name' => 'Công ty TNHH Tư vấn Thiết kế Kiến trúc và Nội thất An Phú',
            'company_brand' => 'An Phú',
            'company_logo' => '',
            'company_address_1' => 'Số 01, liền kề 18, KĐT Văn Khê',
            'company_address_2' => 'Thị trấn Hoàn Long, Hưng Yên',
            'international_name' => 'An Phu Architecture and Interior Design Consulting Company Limited',
            'company_email' => 'kientrucnoithat.anphu@gmail.com',
            'company_phone_1' => '0901234567',
            'company_phone_2' => '0912345678',
            'working_hours' => 'Thứ 2 - Thứ 6: 8:00 - 17:30 | Thứ 7: 8:00 - 12:00',
            'social_links' => [
                'facebook' => 'https://www.facebook.com/share/16aNn1KZ37/?mibextid=wwXIfr',
                'youtube' => 'https://youtube.com/',
                'tiktok' => 'https://www.tiktok.com/@anphudesign',
                'instagram' => 'https://www.instagram.com/',
            ],
            'certificates' => [],
            'certificates_public_ids' => [],
            'google_map' => [
                'map_1' => [
                    'embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4651.941213619061!2d105.76204787601887!3d20.9752479896129!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3134530013984bd5%3A0xa071284b1bd0393f!2sAn%20Ph%C3%BA%20Design!5e1!3m2!1svi!2s!4v1751625845553!5m2!1svi!2s',
                    'coordinates' => ['lat' => 20.9752479896129, 'lng' => 105.76204787601887],
                ],
                'map_2' => [
                    'embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d33853.79464127152!2d105.9599174885666!3d20.9113837101855!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135a5503419c553%3A0x736a6edb8fe3f43c!2zSG_DoG4gTG9uZywgWcOqbiBN4bu5LCBIxrBuZyBZw6puLCBWaeG7h3QgTmFt!5e1!3m2!1svi!2s!4v1755242241297!5m2!1svi!2s',
                    'coordinates' => ['lat' => 20.9113849, 'lng' => 105.980566],
                ],
            ],
        ]);

    }
}
