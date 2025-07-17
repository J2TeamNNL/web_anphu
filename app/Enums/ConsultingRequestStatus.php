<?php

namespace App\Enums;

enum ConsultingRequestStatus: int
{
    case Pending = 0;
    case Processing = 1;
    case Contacted = 2;
    case Rejected = 3;

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Chờ xử lý',
            self::Processing => 'Đang xử lý',
            self::Contacted => 'Đã liên hệ',
            self::Rejected => 'Từ chối',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Pending => 'secondary',
            self::Processing => 'primary',
            self::Contacted => 'success',
            self::Rejected => 'danger',
        };
    }
}
