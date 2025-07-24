<?php

namespace App\Enums;

enum CategoryType: string
{
    case PORTFOLIO = 'portfolio';
    case PORTFOLIO_TYPE = 'portfolio_type';
    case ARTICLE = 'article';
    case ARTICLE_TYPE = 'article_type';
    case PRICE = 'price';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
