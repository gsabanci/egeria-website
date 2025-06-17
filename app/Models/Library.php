<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Library extends Model
{
    use HasFactory, SoftDeletes;

    public function category()
    {
        return $this->hasOne(LibraryCategory::class, 'library_category_guid', 'library_category_guid');
    }
}
