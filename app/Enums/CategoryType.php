<?php

namespace App\Enums;

enum CategoryType: string
{
    case PORTFOLIO = 'portfolio';
    case ARTICLE = 'article';


    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match($this) {
            self::PORTFOLIO => 'Dự án',
            self::ARTICLE   => 'Bài viết',
        };
    }

    public static function fromValue(?string $value): ?self
    {
        foreach (self::cases() as $case) {
            if ($case->value === $value) return $case;
        }
        return null;
    }
}
