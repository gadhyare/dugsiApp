<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmplooyesLevels extends Model
{
    use HasFactory;


    protected $table = "emplooyes_levels";

    protected $fillable = [
        'name' ,
        'active'
    ];


    public function employees_jobs()
    {
        $this->hasMany(Employees_job::class);

    }
}
