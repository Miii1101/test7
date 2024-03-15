<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $table = 'manufacturers';
    use HasFactory;

    protected $guarded = [
        '_token',
    ];

    // protected $fillable = [
    //     'str',
    // ];
    
    
    
}
