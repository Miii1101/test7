<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Article extends Model
{
    protected $fillable = [
        'productImage',
        'name',
        'price',
        'stock',
        'company',
        'detail',
        'created_at',
        'updated_at',
        
    ];

    public function getList()
    {
        return $this->paginate(5);
    }
}