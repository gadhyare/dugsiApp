<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;




    protected $table = "role";


    protected $fillable = [
        'name',
        'name_ar'
    ];




    public function admin(){
        return $this->hasMany(Admins::class);
    }
}
