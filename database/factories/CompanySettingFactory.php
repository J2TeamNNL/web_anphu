<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CompanySetting;

class CompanySettingFactory extends Factory
{
    protected $model = CompanySetting::class;

    public function definition()
    {
        return [
            'established_date'        => $this->faker->date(),
            'tax_code'                => $this->faker->numerify('##########'),
            'director'                => $this->faker->name(),
            'company_name'            => $this->faker->company(),
            'company_brand'           => $this->faker->companySuffix(),
            'international_name'      => $this->faker->company(),
            'company_logo'            => null,
            'company_logo_public_id'  => null,
            'company_email'           => $this->faker->companyEmail(),
            'company_phone_1'         => $this->faker->phoneNumber(),
            'company_phone_2'         => $this->faker->phoneNumber(),
            'company_address_1'       => $this->faker->address(),
            'company_address_2'       => $this->faker->address(),
            'social_links'            => [
                'facebook'  => 'https://facebook.com/',
                'youtube'   => 'https://youtube.com/',
                'tiktok'    => 'https://tiktok.com/',
                'instagram' => 'https://instagram.com/',
            ],
            'certificates'            => [],
            'certificates_public_ids' => [],
            'working_hours'           => '08:00 - 17:00',
            'policy_content'          => null,
            'google_map'              => [
                'map_1' => [
                'embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4651.941213619061!2d105.76204787601887!3d20.9752479896129!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3134530013984bd5%3A0xa071284b1bd0393f!2sAn%20Ph%C3%BA%20Design!5e1!3m2!1svi!2s!4v1751625845553!5m2!1svi!2s',

                'coordinates' => [
                    'lat' => 20.9752479896129,
                    'lng' => 105.76204787601887,
                ],
                ],
                'map_2' => [
                    'embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d33853.79464127152!2d105.9599174885666!3d20.9113837101855!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135a5503419c553%3A0x736a6edb8fe3f43c!2zSG_DoG4gTG9uZywgWcOqbiBN4bu5LCBIxrBuZyBZw6puLCBWaeG7h3QgTmFt!5e1!3m2!1svi!2s!4v1755242241297!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade',
                    'coordinates' => [
                        'lat' => 20.9113849,
                        'lng' => 105.980566
                    ],
                ],
            ],
        ];
    }
}
