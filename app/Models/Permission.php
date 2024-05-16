<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;


    protected $table = "permission";

    protected $fillable = [
        'name',
        'name_ar',
        'table_id'
    ];



    public function table(){
        return $this->belongsTo(Tables::class);
    }


    public function adminPermission()
    {
        return $this->hasMany(AdminPermission::class);
    }

}
