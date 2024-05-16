<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model
{
    use HasFactory;

    protected $table = "admin_permissions";

    protected $fillable = [
        'permission_id',
        'admin_id',
    ];




    public function  permission(){

        return $this->belongsTo(Permission::class);
    }


    public function  admin()
    {
        return $this->belongsTo(Admins::class);
    }



    
}




