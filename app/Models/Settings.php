<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = "settings";
    protected $primaryKey = null;
    public $incrementing = false;


    protected $fillable = [
        'name',
        'description',
        'address',
        'phones',
        'email',
        'url',
        'logo',
        'active',
        'close_message',
    ];
}
