<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    use Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'avatar',
        'level',
        'email',
        'password', 
    ];

    public static function getLevels(): array
    {
        return [
            '0' => 'Admin',
            '1' => 'SuperAdmin',
        ];
    }
}