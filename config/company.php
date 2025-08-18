<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Company Information
    |--------------------------------------------------------------------------
    |
    | This file contains all company-related information that is used
    | throughout the application, including contact details, social media
    | links, and business registration information.
    |
    */

    'name' => [
        'full' => 'Công ty TNHH Tư vấn Thiết kế Kiến trúc và Nội thất An Phú',
        'international' => 'An Phu Architecture and Interior Design Consulting Company Limited',
        'short' => 'An Phú Build',
        'brand' => 'An Phú',
    ],

    'contact' => [
        'address' => 'Số 35 phố Ngõ Huyện, Phường Hàng Trống, Quận Hoàn Kiếm, Thành phố Hà Nội, Việt Nam',
        'phone_1' => '0949 453 283',
        'phone_link_1' => 'tel:0949453283',
        'phone_2' => '0969 317 331',
        'phone_link_2' => 'tel:0969317331',
        'address_1' => 'Số 01, liền kề 18, KĐT Văn Khê',
        'address_2' => 'Thị trấn Hoàn Long, Hưng Yên',
        'email' => 'kientrucnoithat.anphu@gmail.com',
        'email_link' => 'mailto:kientrucnoithat.anphu@gmail.com',
    ],

    'business' => [
        'license_number' => '0108588362',
        'license_authority' => 'Sở KHĐT T.P. Hà Nội',
        'license_date' => '15/01/2019',
        'license_full_text' => 'Giấy chứng nhận ĐKKD số 0108588362 do Sở KHĐT T.P. Hà Nội cấp ngày 15/01/2019',
    ],

    'social_media' => [
        'zalo' => [
            'url' => 'https://zalo.me/0969317331',
            'icon' => null, // Uses custom logo
            'name' => 'Zalo',
            'logo' => 'assets/img/logo/logo_zalo.png',
            'color' => '#0068ff',
        ],
        'facebook' => [
            'url' => 'https://www.facebook.com/share/16aNn1KZ37/?mibextid=wwXIfr',
            'icon' => 'fab fa-facebook-f',
            'name' => 'Facebook',
            'color' => '#1877f2',
        ],
        'tiktok' => [
            'url' => 'https://www.tiktok.com/@anphudesign',
            'icon' => 'fab fa-tiktok',
            'name' => 'TikTok',
            'logo' => 'assets/img/logo/logo_tiktok.png',
            'color' => '#000000',
        ],
        'youtube' => [
            'url' => 'https://www.youtube.com/@anphudesign',
            'icon' => 'fab fa-youtube',
            'name' => 'YouTube',
            'color' => '#ff0000',
        ],
    ],

    'assets' => [
        'logo' => [
            'main' => 'assets/img/logo/banner.jpg',
            'favicon' => 'assets/img/logo/favicon.ico',
            'footer' => 'assets/img/logo/banner.jpg',
        ],
        'certification' => [
            'bocongthuong' => 'assets/img/logo/bocongthuong_thongbao.png',
        ],
        'background' => [
            'footer' => 'assets/img/gallery/background_danmask_1.jpg',
        ],
    ],

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

    'privacy_policy' => [
        'text' => 'Chính Sách Công ty',
    ],

    'working_hours' => [
        'weekdays' => '8:00 - 17:30',
        'saturday' => '8:00 - 12:00',
        'sunday' => 'Nghỉ',
        'text' => 'Thứ 2 - Thứ 6: 8:00 - 17:30 | Thứ 7: 8:00 - 12:00',
    ],
    
    'copyright' => [
        'text' => '© An Phú Build. All rights reserved.',
    ],
];
