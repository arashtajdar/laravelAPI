<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        "code", "title", "description", "category_id"
    ];

    // Todo : use relations for category
    public function category(){
        return $this->hasOne(Category::class,"id","category_id");
    }
}
