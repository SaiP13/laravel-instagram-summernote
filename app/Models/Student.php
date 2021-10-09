<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table="students";

    protected $fillable = [
        'name', 'gender'
    ];

    public function marks()
    {
        // return $this->hasOne(Marks::class);
        return $this->hasMany(Marks::class);
    }
}
