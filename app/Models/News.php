<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->hasOne(NewsCategory::class, 'nc_guid', 'nc_guid');
    }
}
