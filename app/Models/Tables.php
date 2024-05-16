<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tables extends Model
{
    use HasFactory;

    protected $table = "table";


    protected $fillable = [
        'name',
        'name_ar'
    ];





    public function permission(){
        return $this->hasMany(Permission::class);
    }
}
