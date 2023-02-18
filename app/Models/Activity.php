<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail($id)
 * @method static create(mixed $validatedData)
 */
class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        "code", "title", "description", "type" , "user", "city", "location", "start", "end", "type_id"
    ];
}
