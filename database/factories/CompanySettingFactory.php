<?php

namespace Database\Factories;

use App\Models\CompanySetting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanySetting>
 */
class CompanySettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name'=> 'Công ty TNHH Tư vấn Thiết kế Kiến trúc và Nội thất An Phú',
            'company_logo'=> '',
            'company_email'=> 'kientrucnoithat.anphu@gmail.com',
            'company_phone_1'=> '0949 453 283',
            'company_phone_2'=> ' 0969 317 331',
            'company_address_1'=> 'Số 01, liền kề 18, KĐT Văn Khê',
            'company_address_2'=> 'Thị trấn Hoàn Long, Hưng Yên',
            'social_links' => json_encode([
                'zalo' => '',
                'facebook'  => '',
                'tiktok'  => '',
            ]),
            'working_hours' => 'Thời gian: 8h - 17h30 T2 - T7',
            'policy_content' => '',
            'google_map' => '',
        ];
    }
}
