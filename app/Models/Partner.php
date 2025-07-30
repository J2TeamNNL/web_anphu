<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Partner extends Model
{   
    use HasFactory;

    use Notifiable;

    protected $fillable = [
        'name',
        'logo',
        'link',
        'description',
    ];
}